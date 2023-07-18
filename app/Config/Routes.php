<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/login', 'AdminLogin::index');
$routes->get('/dashboard', 'dashboardController::index');
$routes->get('/dashboard/fakultas', 'dashboardController::fakultas');
$routes->get('/dashboard/prodi', 'dashboardController::prodi');
$routes->get('/dashboard/matakuliah', 'dashboardController::matakuliah');
$routes->get('/dashboard/konsentrasi', 'dashboardController::konsentrasi');
$routes->get('/dashboard/konsentrasi_matakuliah', 'dashboardController::konsentrasi_matakuliah');
$routes->post('/login', 'AdminLogin::authentication');
$routes->get('/signup', 'AdminLogin::signup');
$routes->put('/signup', 'AdminLogin::register');
$routes->post('/data/fakultas/store', 'simDataController::fakultas_store');
$routes->post('/data/fakultas/update', 'simDataController::fakultas_update');
$routes->post('/data/fakultas/delete', 'simDataController::fakultas_delete');
$routes->post('/data/prodi/store', 'simDataController::prodi_store');
$routes->post('/data/prodi/update', 'simDataController::prodi_update');
$routes->post('/data/prodi/delete', 'simDataController::prodi_delete');
$routes->post('/data/prodi/store', 'simDataController::prodi_store');
$routes->post('/data/matakuliah/store', 'simDataController::matakuliah_store');
$routes->post('/data/matakuliah/update', 'simDataController::matakuliah_update');
$routes->post('/data/matakuliah/delete', 'simDataController::matakuliah_delete');
$routes->post('/data/konsentrasi/store', 'simDataController::konsentrasi_store');
$routes->post('/data/konsentrasi/update', 'simDataController::konsentrasi_update');
$routes->post('/data/konsentrasi/delete', 'simDataController::konsentrasi_delete');
$routes->post('/data/konsentrasi_matakuliah/store', 'simDataController::konsentrasi_matakuliah_store');
$routes->post('/data/konsentrasi_matakuliah/update', 'simDataController::konsentrasi_matakuliah_update');
$routes->post('/data/konsentrasi_matakuliah/delete', 'simDataController::konsentrasi_matakuliah_delete');
$routes->get('/simulasi', 'simulasiController::index');
$routes->get('/get-data', 'simulasiController::getData');
$routes->get('/get-matakuliah', 'simulasiController::getSemester');
$routes->get('/get-konsentrasi', 'simulasiController::getKonsentrasi');
$routes->get('/get-prodi', 'simulasiController::getProdi');
$routes->get('/get-prodi-konsentrasi', 'simulasiController::getProdiKonsentrasi');



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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}