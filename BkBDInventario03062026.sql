CREATE DATABASE  IF NOT EXISTS `inventario` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `inventario`;
-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: localhost    Database: inventario
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID único del cliente',
  `nombres` varchar(150) NOT NULL COMMENT 'Nombres del cliente',
  `apellidos` varchar(150) NOT NULL COMMENT 'Apellidos del cliente',
  `pais_origen` varchar(100) DEFAULT NULL COMMENT 'País del cliente',
  `fecha_nacimiento` date DEFAULT NULL COMMENT 'Fecha de nacimiento',
  `email` varchar(255) NOT NULL COMMENT 'Correo electrónico del cliente',
  `id_tributario` varchar(50) NOT NULL COMMENT 'Número tributario único del cliente',
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `id_tributario` (`id_tributario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Datos generales de los clientes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Nelson','Menjivar','MX','1969-07-24','jnmg2407@gmail.com','01322'),(2,'Guardado','Nelson','El Salvador','1979-07-24','nmenjiva@gmail.com','123');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamentos` (
  `id_departamento` varchar(2) NOT NULL COMMENT 'Código del departamento',
  `descripcion` varchar(100) NOT NULL COMMENT 'Nombre del departamento',
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Catálogo de departamentos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES ('','Nelson'),('1','Ahuachapán'),('10','San Vicente'),('11','Usulután'),('12','San Miguel'),('13','Morazán'),('14','La Unión'),('2','Santa Ana'),('3','Sonsonate'),('4','Chalatenango'),('5','La Libertad'),('6','San Salvador'),('7','Cuscatlán'),('8','La Paz'),('9','Cabañas');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distritos`
--

DROP TABLE IF EXISTS `distritos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `distritos` (
  `id_departamento` varchar(2) NOT NULL COMMENT 'Código del departamento',
  `id_municipio` varchar(2) NOT NULL COMMENT 'Código del municipio',
  `id_distrito` varchar(2) NOT NULL COMMENT 'Código del distrito',
  `descripcion` varchar(150) NOT NULL COMMENT 'Nombre del distrito',
  PRIMARY KEY (`id_departamento`,`id_municipio`,`id_distrito`),
  CONSTRAINT `fk_Distritos_Municipios` FOREIGN KEY (`id_departamento`, `id_municipio`) REFERENCES `municipios` (`id_departamento`, `id_municipio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Catálogo de distritos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distritos`
--

LOCK TABLES `distritos` WRITE;
/*!40000 ALTER TABLE `distritos` DISABLE KEYS */;
/*!40000 ALTER TABLE `distritos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventario`
--

DROP TABLE IF EXISTS `inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventario` (
  `id_producto` int(11) NOT NULL COMMENT 'Producto asociado',
  `id_sucursal` int(11) NOT NULL COMMENT 'Sucursal o punto de venta',
  `cantidad_actual` int(11) NOT NULL DEFAULT 0 COMMENT 'Cantidad disponible en inventario',
  `cantidad_minima_alerta` int(11) NOT NULL DEFAULT 10 COMMENT 'Cantidad mínima para alerta de stock bajo',
  `id_departamento` varchar(2) NOT NULL COMMENT 'Ubicación: departamento',
  `id_municipio` varchar(2) NOT NULL COMMENT 'Ubicación: municipio',
  `id_distrito` varchar(2) NOT NULL COMMENT 'Ubicación: distrito',
  PRIMARY KEY (`id_producto`,`id_sucursal`),
  KEY `id_producto` (`id_producto`),
  KEY `id_departamento` (`id_departamento`,`id_municipio`,`id_distrito`),
  KEY `fk_Inventario_Sucursales` (`id_sucursal`),
  CONSTRAINT `fk_Inventario_Distritos` FOREIGN KEY (`id_departamento`, `id_municipio`, `id_distrito`) REFERENCES `distritos` (`id_departamento`, `id_municipio`, `id_distrito`) ON UPDATE CASCADE,
  CONSTRAINT `fk_Inventario_Productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Inventario_Sucursales` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Control de inventario por sucursal';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventario`
--

LOCK TABLES `inventario` WRITE;
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipios`
--

DROP TABLE IF EXISTS `municipios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `municipios` (
  `id_departamento` varchar(2) NOT NULL COMMENT 'Departamento al que pertenece',
  `id_municipio` varchar(2) NOT NULL COMMENT 'Código del municipio',
  `descripcion` varchar(150) NOT NULL COMMENT 'Nombre del municipio',
  PRIMARY KEY (`id_departamento`,`id_municipio`),
  CONSTRAINT `fk_Municipios_Departamentos` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Catálogo de municipios';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipios`
--

LOCK TABLES `municipios` WRITE;
/*!40000 ALTER TABLE `municipios` DISABLE KEYS */;
INSERT INTO `municipios` VALUES ('12','','Sesori'),('4','','Producto Nelson');
/*!40000 ALTER TABLE `municipios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opciones`
--

DROP TABLE IF EXISTS `opciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `opciones` (
  `id_opcion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de la opción',
  `descripcion` varchar(255) NOT NULL COMMENT 'Descripción de la opción disponible',
  `b_activa` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Indica si está activa',
  PRIMARY KEY (`id_opcion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Opciones o permisos del sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opciones`
--

LOCK TABLES `opciones` WRITE;
/*!40000 ALTER TABLE `opciones` DISABLE KEYS */;
INSERT INTO `opciones` VALUES (1,'Facturacion',0),(2,'Ventas',1);
/*!40000 ALTER TABLE `opciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID único del producto',
  `descripcion_corta` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nombre corto del producto',
  `descripcion_larga` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Descripción general del producto',
  `presentacion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Presentación del producto (caja, unidad, etc.)',
  `pais_origen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'País de fabricación del producto',
  `cantidad_maxima` int(11) NOT NULL DEFAULT 100 COMMENT 'Cantidad máxima permitida en inventario',
  `cantidad_actual` int(11) NOT NULL DEFAULT 0 COMMENT 'Stock actual del producto',
  `precio_unitario` decimal(10,2) NOT NULL COMMENT 'Costo unitario del producto',
  `precio_venta` decimal(10,2) NOT NULL COMMENT 'Precio de venta al público',
  `codigo_barras` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Código de barras único del producto',
  `id_proveedor` int(11) NOT NULL COMMENT 'Proveedor que suministra el producto',
  `id_sucursal` int(11) DEFAULT NULL COMMENT 'Llave de la sucursal de venta',
  `numero_lote` varchar(50) DEFAULT NULL COMMENT 'Numero de Lote',
  `f_vencimiento` date DEFAULT NULL COMMENT 'Fecha de vencimiento del lote',
  PRIMARY KEY (`id_producto`),
  UNIQUE KEY `codigo_barras` (`codigo_barras`),
  KEY `id_proveedor` (`id_proveedor`),
  CONSTRAINT `fk_Productos_Proveedores` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Catálogo de productos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (6,'Producto 1','sffsff sffsfsdfsfsdf  dss  fsd ','Libras','MX',1000,108,5.00,7.00,'0101010102020203030303',1,1,NULL,NULL),(8,'Producto 3','Prueba producto tres.','Kilos','ES',1000,428,25.00,35.00,'252525010101',1,1,NULL,NULL),(9,'Producto cuatro','Este producto es una prueba de llenado de fecha',NULL,NULL,5000,1150,1.25,1.50,'eeeeeeff',3,2,'ABC123','2026-04-30'),(10,'Tomatoes','Tomates Rojos, Verdosos y paliduchos',NULL,NULL,600,5000,0.25,0.35,'||||||',1,3,'ABC-123','2026-06-15');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único del proveedor',
  `descripcion_corta` varchar(100) NOT NULL COMMENT 'Nombre corto del proveedor',
  `descripcion_larga` text DEFAULT NULL COMMENT 'Descripción extendida del proveedor',
  `pais_origen` varchar(100) DEFAULT NULL COMMENT 'País de origen del proveedor',
  `id_tributario` varchar(50) NOT NULL COMMENT 'Número tributario único',
  `representante_legal` varchar(255) DEFAULT NULL COMMENT 'Nombre del representante legal',
  `correo_proveedor` varchar(255) NOT NULL COMMENT 'Correo de contacto del proveedor',
  PRIMARY KEY (`id_proveedor`),
  UNIQUE KEY `id_tributario` (`id_tributario`),
  UNIQUE KEY `correo_proveedor` (`correo_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Catálogo de proveedores registrados';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'Nelson','Nenjivar Guardado','MX','0101','Nelson Menjivar','nmenjiva@gmail.com01'),(3,'La Tiendona','Prueba de la Tiendona al por mayor y menor','ES','01322','Nelson Menjivar','jnmg2407@gmail.com'),(4,'Demo Clase','dsfksdfs fsdf sdfsdlfnlsdfknsdlfsdfsf','SV','1225','Nelson Menjivar','nmenjiva@gmail.com');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol_opcion`
--

DROP TABLE IF EXISTS `rol_opcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol_opcion` (
  `id_rol` int(11) NOT NULL COMMENT 'Rol asignado',
  `id_opcion` int(11) NOT NULL COMMENT 'Opción asignada al rol',
  PRIMARY KEY (`id_rol`,`id_opcion`) USING BTREE,
  KEY `fk_Rol_Opcion_Opciones` (`id_opcion`) USING BTREE,
  CONSTRAINT `fk_Rol_Opcion_Opciones` FOREIGN KEY (`id_opcion`) REFERENCES `opciones` (`id_opcion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Relación de roles con opciones';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol_opcion`
--

LOCK TABLES `rol_opcion` WRITE;
/*!40000 ALTER TABLE `rol_opcion` DISABLE KEYS */;
INSERT INTO `rol_opcion` VALUES (2,2),(3,2);
/*!40000 ALTER TABLE `rol_opcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID del rol',
  `descripcion` varchar(100) NOT NULL COMMENT 'Descripción del rol',
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Catálogo de roles del sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador'),(2,'Cajero'),(3,'Supervisor'),(4,'Ayudante');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sucursales`
--

DROP TABLE IF EXISTS `sucursales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sucursales` (
  `id_sucursal` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre de la tienda/bodega',
  `direccion` text DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Puntos de venta o bodegas';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sucursales`
--

LOCK TABLES `sucursales` WRITE;
/*!40000 ALTER TABLE `sucursales` DISABLE KEYS */;
INSERT INTO `sucursales` VALUES (2,'Casa Matriz','Mi casita.','005RIENT'),(3,'La Gloria','Cerca del Cielo','45454545'),(5,'UTLA','UTLA LAb Ssitemas','005RIENT');
/*!40000 ALTER TABLE `sucursales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_roles`
--

DROP TABLE IF EXISTS `usuario_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario_roles` (
  `id_usuario` int(11) NOT NULL COMMENT 'Usuario asociado',
  `id_rol` int(11) NOT NULL COMMENT 'Rol asignado',
  `b_activa` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Indica si el rol está activo',
  PRIMARY KEY (`id_usuario`,`id_rol`),
  KEY `fk_Usuario_Roles_Roles` (`id_rol`),
  CONSTRAINT `fk_Usuario_Roles_Roles` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Usuario_Roles_Usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Relación de usuarios con roles';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_roles`
--

LOCK TABLES `usuario_roles` WRITE;
/*!40000 ALTER TABLE `usuario_roles` DISABLE KEYS */;
INSERT INTO `usuario_roles` VALUES (1,1,1),(5,2,1);
/*!40000 ALTER TABLE `usuario_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID del usuario',
  `nombre` varchar(150) NOT NULL COMMENT 'Nombre del usuario',
  `email` varchar(255) NOT NULL COMMENT 'Correo del usuario',
  `password` varchar(255) NOT NULL COMMENT 'Contraseña encriptada',
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Usuarios del sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'JNelsonMenjivarG','nmenjiva@gmail.com','1234',1),(5,'Nelson Guardado','jnmg2407@gmail.com','1234',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_detalle`
--

DROP TABLE IF EXISTS `venta_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venta_detalle` (
  `id_venta` int(11) NOT NULL COMMENT 'Referencia a venta',
  `id_producto` int(11) NOT NULL COMMENT 'Producto vendido',
  `cantidad` int(11) NOT NULL COMMENT 'Cantidad vendida',
  `precio_unitario` decimal(10,2) NOT NULL COMMENT 'Precio unitario aplicado',
  `subtotal` decimal(12,2) NOT NULL COMMENT 'Subtotal de la línea',
  PRIMARY KEY (`id_venta`,`id_producto`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `fk_Venta_Detalle_Productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON UPDATE CASCADE,
  CONSTRAINT `fk_Venta_Detalle_Ventas` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Detalle de productos en cada venta';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_detalle`
--

LOCK TABLES `venta_detalle` WRITE;
/*!40000 ALTER TABLE `venta_detalle` DISABLE KEYS */;
INSERT INTO `venta_detalle` VALUES (16,8,6,35.00,0.00),(38,6,6,7.00,0.00),(38,8,5,35.00,0.00),(39,6,5,7.00,0.00),(40,6,5,7.00,0.00),(40,8,6,35.00,0.00),(41,6,5,7.00,0.00),(41,8,6,35.00,0.00),(42,6,5,7.00,0.00),(42,8,6,35.00,0.00),(43,6,5,7.00,0.00),(43,8,6,35.00,0.00),(44,6,5,7.00,0.00),(44,8,6,35.00,0.00),(45,6,5,7.00,0.00),(45,8,6,35.00,0.00),(46,6,5,7.00,0.00),(46,8,6,35.00,0.00),(47,6,5,7.00,0.00),(47,8,6,35.00,0.00),(48,6,5,7.00,0.00),(48,8,6,35.00,0.00),(49,6,5,7.00,0.00),(49,8,6,35.00,0.00),(50,6,6,7.00,0.00),(51,6,25,7.00,0.00),(52,8,25,35.00,0.00),(53,6,3,7.00,0.00),(54,6,3,7.00,0.00),(55,6,1,7.00,0.00),(55,8,1,35.00,0.00),(56,8,10,35.00,0.00),(56,9,25,1.50,0.00);
/*!40000 ALTER TABLE `venta_detalle` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER tg_descontar_stock_venta
AFTER INSERT ON venta_detalle
FOR EACH ROW
BEGIN
    UPDATE productos 
    SET cantidad_actual = cantidad_actual - NEW.cantidad
    WHERE id_producto = NEW.id_producto;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de la venta',
  `id_cliente` int(11) NOT NULL COMMENT 'Cliente que realiza la compra',
  `fecha_venta` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de la venta',
  `tipo_documento` varchar(50) NOT NULL COMMENT 'Factura, Ticket, Crédito Fiscal, etc.',
  `numero_documento` varchar(100) DEFAULT NULL COMMENT 'Número del documento',
  `monto_total` decimal(12,2) NOT NULL COMMENT 'Monto total de la venta',
  `estado` varchar(50) NOT NULL DEFAULT 'Completada' COMMENT 'Completada o anulada',
  `id_usuario` int(11) NOT NULL,
  `id_sucursal` int(11) DEFAULT NULL COMMENT 'Sucursal de la Venta',
  PRIMARY KEY (`id_venta`),
  UNIQUE KEY `numero_documento` (`numero_documento`),
  KEY `id_cliente` (`id_cliente`),
  KEY `fk_ventas_usuarios` (`id_usuario`),
  CONSTRAINT `fk_Ventas_Clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON UPDATE CASCADE,
  CONSTRAINT `fk_ventas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Registro maestro de ventas';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` VALUES (16,1,'2026-04-05 19:22:42','','',210.00,'Completada',1,NULL),(38,1,'2026-04-05 19:24:28','',NULL,217.00,'Completada',1,NULL),(39,1,'2026-04-06 09:26:49','',NULL,35.00,'Completada',1,NULL),(40,1,'2026-04-06 10:16:48','',NULL,245.00,'Completada',1,NULL),(41,1,'2026-04-06 10:16:50','',NULL,245.00,'Completada',1,NULL),(42,1,'2026-04-06 10:16:53','',NULL,245.00,'Completada',1,NULL),(43,1,'2026-04-06 10:16:59','',NULL,245.00,'Completada',1,NULL),(44,1,'2026-04-06 10:17:00','',NULL,245.00,'Completada',1,NULL),(45,1,'2026-04-06 10:17:12','',NULL,245.00,'Completada',1,NULL),(46,1,'2026-04-06 10:49:04','',NULL,245.00,'Completada',1,NULL),(47,1,'2026-04-06 10:49:05','',NULL,245.00,'Completada',1,NULL),(48,1,'2026-04-06 10:49:05','',NULL,245.00,'Completada',1,NULL),(49,1,'2026-04-06 10:50:01','',NULL,245.00,'Completada',1,NULL),(50,1,'2026-04-06 10:53:31','',NULL,42.00,'Completada',1,2),(51,1,'2026-04-06 11:01:15','',NULL,175.00,'Completada',1,2),(52,1,'2026-04-06 11:03:10','',NULL,875.00,'Completada',1,2),(53,1,'2026-04-06 11:09:35','',NULL,21.00,'Completada',1,2),(54,1,'2026-04-06 11:11:45','',NULL,21.00,'Completada',1,2),(55,1,'2026-05-23 16:13:42','',NULL,42.00,'Completada',1,2),(56,2,'2026-05-27 18:51:21','',NULL,387.50,'Completada',1,3);
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'inventario'
--

--
-- Dumping routines for database 'inventario'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-03 18:56:46
