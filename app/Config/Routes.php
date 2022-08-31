<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::inicio');
$routes->get('quienesSomos', 'Home::quienesSomos');
$routes->get('comercializacion', 'Home::comercializacion');
$routes->get('terminos', 'Home::terminos');
$routes->get('panelAdmin/usuarios/listar', 'Usuarios::listar');
$routes->get('panelAdmin/usuarios/activos', 'Usuarios::activos');
$routes->get('panelAdmin/usuarios/eliminados', 'Usuarios::eliminados');
$routes->get('usuarios/registrar', 'Usuarios::registrar');
$routes->post('usuarios/guardar', 'Usuarios::guardar');//envio formulario
$routes->get('usuarios/eliminar/(:num)', 'Usuarios::eliminar/$1');
$routes->get('usuarios/editar/(:num)', 'Usuarios::editar/$1');
$routes->get('usuarios/activar/(:num)', 'Usuarios::activar/$1');
$routes->post('usuarios/actualizar/', 'Usuarios::actualizar/');
$routes->get('usuarios/login/', 'Usuarios::login');
$routes->post('usuarios/validar_cuenta/', 'Usuarios::validar_cuenta');
$routes->post('usuarios/cerrar_sesion/', 'Usuarios::cerrar_sesion');
$routes->get('contacto', 'Contactos::index');
$routes->get('contacto/resuelto/(:num)', 'Contactos::resuelto/$1');
$routes->get('contacto/pendiente/(:num)', 'Contactos::pendiente/$1');
$routes->post('contacto/guardar', 'Contactos::guardar');
$routes->get('panelAdmin/', 'PanelAdmin::index');
$routes->get('panelAdmin/producto/listar', 'PanelAdmin::listarProductos');
$routes->get('panelAdmin/producto/destacados', 'PanelAdmin::listarDestacados');
$routes->get('panelAdmin/producto/eliminados', 'PanelAdmin::listarEliminados');
$routes->get('panelAdmin/producto/agregar', 'PanelAdmin::agregar');
$routes->post('panelAdmin/producto/guardar/', 'PanelAdmin::guardar');
$routes->get('panelAdmin/contacto/listar', 'Contactos::listarContactos');
$routes->get('panelAdmin/contacto/resueltos', 'Contactos::listarResueltos');
$routes->get('panelAdmin/contacto/pendientes', 'Contactos::listarPendientes');
$routes->get('panelAdmin/consulta/listar', 'Consultas::listarConsultas');
$routes->get('panelAdmin/consulta/resueltos', 'Consultas::listarResueltos');
$routes->get('panelAdmin/consulta/pendientes', 'Consultas::listarPendientes');
$routes->get('panelAdmin/factura/listar', 'Facturas::listarFacturas');
$routes->get('panelAdmin/factura/detalles/(:num)', 'Facturas::detalles/$1');
$routes->get('panelAdmin/factura/mostrarPDF/(:num)', 'Facturas::mostrarPDF/$1');
$routes->get('panelAdmin/factura/generarFacturaPDF/(:num)', 'Facturas::generarFacturaPDF/$1');
$routes->get('producto/eliminar/(:num)', 'Productos::eliminar/$1');
$routes->get('producto/activar/(:num)', 'Productos::activar/$1');
$routes->get('producto/destacar/(:num)', 'Productos::destacar/$1');
$routes->get('producto/quitar/(:num)', 'Productos::quitar/$1');
$routes->get('producto/modificar/(:num)', 'Productos::modificar/$1');
$routes->post('producto/actualizar', 'Productos::actualizar');
$routes->get('catalogo/', 'Productos::index');
$routes->post('catalogo/buscar', 'Productos::buscar');
$routes->get('catalogo/categoria/(:num)', 'Productos::buscarCategoria/$1');
$routes->get('catalogo/detalles/(:num)', 'Productos::detalles/$1');
$routes->get('consulta/', 'Consultas::index');
$routes->post('consulta/guardar', 'Consultas::guardar');
$routes->get('consulta/resuelto/(:num)', 'Consultas::resuelto/$1');
$routes->get('consulta/pendiente/(:num)', 'Consultas::pendiente/$1');
$routes->get('carrito/', 'Carrito::index');
$routes->post('carrito/agregar', 'Carrito::agregar');
$routes->post('carrito/actualizar', 'Carrito::actualizar');
$routes->get('carrito/datos', 'Carrito::datos');
$routes->post('carrito/confirmar', 'Carrito::confirmar');
$routes->post('factura/guardar', 'Facturas::guardar');




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
