<?php

class Compra
{
    private $db;

    public function __construct()
    {
        $this->db = $GLOBALS['db'];
    }

    public function all(): array
    {
        $sql = "SELECT c.*, p.descripcion_corta AS proveedor
                FROM Compras c
                INNER JOIN Proveedores p ON p.id_proveedor = c.id_proveedor
                ORDER BY c.fecha_compra DESC";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT c.*, p.descripcion_corta AS proveedor
            FROM Compras c
            INNER JOIN Proveedores p ON p.id_proveedor = c.id_proveedor
            WHERE c.id_compra = :id
            LIMIT 1
        ");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function detalles(int $id_compra): array
    {
        $stmt = $this->db->prepare("
            SELECT d.*, pr.descripcion_corta AS producto
            FROM Compra_Detalle d
            INNER JOIN Productos pr ON pr.id_producto = d.id_producto
            WHERE d.id_compra = :id
        ");
        $stmt->execute([':id' => $id_compra]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function create(array $data, array $items): int
    {
        $this->db->beginTransaction();

        try {
            // 1) Insert compra
            $stmt = $this->db->prepare("
                INSERT INTO Compras (id_proveedor, numero_documento, monto_total)
                VALUES (:prov, :numdoc, :total)
            ");
            $stmt->execute([
                ':prov'   => $data['id_proveedor'],
                ':numdoc' => $data['numero_documento'],
                ':total'  => $data['monto_total'],
            ]);

            $id_compra = (int) $this->db->lastInsertId();

            // 2) Insert detalle
            $stmtDet = $this->db->prepare("
                INSERT INTO Compra_Detalle
                    (id_compra, id_producto, cantidad, precio_unitario, subtotal)
                VALUES (:idc, :idp, :cant, :precio, :sub)
            ");

            foreach ($items as $item) {
                $stmtDet->execute([
                    ':idc'    => $id_compra,
                    ':idp'    => $item['id_producto'],
                    ':cant'   => $item['cantidad'],
                    ':precio' => $item['precio_unitario'],
                    ':sub'    => $item['subtotal'],
                ]);

                // OPCIONAL: Actualizar inventario (ejemplo simple, sucursal fija 1)
                $invStmt = $this->db->prepare("
                    INSERT INTO Inventario (
                        id_producto, id_sucursal, cantidad_actual, cantidad_minima_alerta,
                        id_departamento, id_municipio, id_distrito
                    ) VALUES (:prod, 1, :cant, 10, '01', '01', '01')
                    ON DUPLICATE KEY UPDATE cantidad_actual = cantidad_actual + VALUES(cantidad_actual)
                ");

                $invStmt->execute([
                    ':prod' => $item['id_producto'],
                    ':cant' => $item['cantidad'],
                ]);
            }

            $this->db->commit();
            return $id_compra;

        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}
