<?php

return [

// FORMULARIO LOGIN (GET)
'login' => ['AuthController', 'loginForm'],

// PROCESAR LOGIN (POST)
'login_post' => ['AuthController', 'login'],

// LOGOUT
'logout' => ['AuthController', 'logout'],

// DASHBOARD
'' => ['DashboardController', 'index'],
'dashboard' => ['DashboardController', 'index'],

// Usuarios
'usuarios'             => ['UsuariosController', 'index'],
'usuarios/crear'       => ['UsuariosController', 'crear'],
'usuarios/editar'      => ['UsuariosController', 'editar'],
'usuarios/eliminar'    => ['UsuariosController', 'eliminar'],

// CRUD de Roles
'roles'           => ['RolesController', 'index'],
'roles/crear'     => ['RolesController', 'crear'],
'roles/editar'    => ['RolesController', 'editar'],
'roles/eliminar'  => ['RolesController', 'eliminar'],

// Proveedores
'proveedores'             => ['ProveedoresController', 'index'],
'proveedores/crear'       => ['ProveedoresController', 'crear'],
'proveedores/crear_post'  => ['ProveedoresController', 'crearPost'],
'proveedores/editar'      => ['ProveedoresController', 'editar'],
'proveedores/editar_post' => ['ProveedoresController', 'editarPost'],
'proveedores/eliminar'    => ['ProveedoresController', 'eliminar'],

// Compras
'compras'              => ['ComprasController', 'index'],
'compras/crear'        => ['ComprasController', 'crear'],
'compras/crear_post'   => ['ComprasController', 'crearPost'],
'compras/ver'          => ['ComprasController', 'ver'],     // detalle de una compra

// Reportes
'reportes/compras'      => ['ReportesController', 'compras'],
'reportes/existencias'  => ['ReportesController', 'existencias'],
'reportes/ventas'       => ['ReportesController', 'ventas'],
'reportes/stock'        => ['ReportesController', 'stock'],
'reportes/mensual'      => ['ReportesController', 'mensual'],


];