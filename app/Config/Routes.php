<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function () {
	echo view('errors/index');
});
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// Home Page fix
$routes->add('/', 'Home::index');
// Auth Page fix
$routes->add('/auth', 'Auth::index', ['filter' => 'auth']);
// Dashboard Page fix
$routes->add('/dashboard', 'Dashboard::index', ['filter' => 'noauth']);
// User Page fix
$routes->add('/user', 'User::index', ['filter' => 'noauth']);
$routes->add('/user/edituser/(:any)', 'User::edituser/$1', ['filter' => 'noauth']);
$routes->add('/user/detailuser/(:any)', 'User::detailuser/$1', ['filter' => 'noauth']);
$routes->add('/user/deleteuser/(:any)', 'User::deleteuser/$1', ['filter' => 'noauth']);
// Absent Page fix
$routes->add('/absent/', 'Absent::index', ['filter' => 'noauth']);
$routes->add('/absent/check', 'Absent::check', ['filter' => 'noauth']);
$routes->add('/absent/turn', 'Absent::turn', ['filter' => 'noauth']);
$routes->add('/absent/listabsent/', 'Absent::listabsent', ['filter' => 'noauth']);
$routes->add('/absent/listabsent/(:num)/(:num)', 'Absent::listabsent/$1/$2', ['filter' => 'noauth']);
$routes->add('/absent/manageabsent/', 'Absent::manageabsent', ['filter' => 'noauth']);
$routes->add('/absent/manageabsent/(:any)/(:any)/(:any)/(:any)/(:any)', 'Absent::manageabsent/$1/$2/$3/$4/$5', ['filter' => 'noauth']);
$routes->add('/absent/editabsent/(:any)/(:any)', 'Absent::editabsent/$1/$2', ['filter' => 'noauth']);
$routes->add('/absent/editabsent/(:any)/(:any)', 'Absent::editabsent/$1/$2', ['filter' => 'noauth']);
// Team page fix
$routes->add('/team', 'Team::index', ['filter' => 'noauth']);
$routes->add('/team/editteam/(:any)', 'Team::editteam/$1', ['filter' => 'noauth']);
$routes->add('/team/createteam', 'Team::createteam', ['filter' => 'noauth']);
$routes->add('/team/deleteteam/(:any)', 'Team::deleteteam/$1', ['filter' => 'noauth']);

/**
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
