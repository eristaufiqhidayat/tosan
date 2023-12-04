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
 * Route Definitions users/cpass/0/0 /index.php/users/cpassdo
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');
$routes->get('/', 'Home::index', ['filter' => 'role:admin, user']);
$routes->get('/users/index/(:any)/(:any)', 'Admin\CUser::index/$1/$2', ['filter' => 'role:admin']);
$routes->post('/users/tambah/(:any)/(:any)', 'Admin\CUser::tambah/$1/$2', ['filter' => 'role:admin']);
$routes->post('/users/hapus/(:any)/(:any)', 'Admin\CUser::hapus/$1/$2', ['filter' => 'role:admin']);
$routes->post('/users/edit/(:any)/(:any)', 'Admin\CUser::rubah/$1/$2', ['filter' => 'role:admin']);
$routes->get('/users/cpass/(:any)/(:any)', 'Admin\CUser::CPass/$1/$2');
$routes->post('/users/cpassdo/(:any)/(:any)', 'Admin\CUser::CPassDo/$1/$2');

$routes->get('/groups/index/(:any)/(:any)', 'Admin\CGroups::index/$1/$2', ['filter' => 'role:admin']);
$routes->post('/groups/tambah/(:any)/(:any)', 'Admin\CGroups::tambah/$1/$2', ['filter' => 'role:admin']);
$routes->post('/groups/edit/(:any)/(:any)', 'Admin\CGroups::rubah/$1/$2', ['filter' => 'role:admin']);
$routes->post('/groups/hapus/(:any)/(:any)', 'Admin\CGroups::hapus/$1/$2', ['filter' => 'role:admin']);

$routes->get('/permission/index/(:any)/(:any)', 'Admin\CPermission::index/$1/$2', ['filter' => 'role:admin']);
$routes->post('/permission/tambah/(:any)/(:any)', 'Admin\CPermission::tambah/$1/$2', ['filter' => 'role:admin']);
$routes->post('/permission/hapus/(:any)/(:any)', 'Admin\CPermission::hapus/$1/$2', ['filter' => 'role:admin']);
$routes->post('/permission/edit/(:any)/(:any)', 'Admin\CPermission::rubah/$1/$2', ['filter' => 'role:admin']);

$routes->get('/permissiongroups/index/(:any)/(:any)', 'Admin\CPermissionGroups::index/$1/$2', ['filter' => 'role:admin']);
$routes->post('/permissiongroups/update/(:any)/(:any)', 'Admin\CPermissionGroups::permissionGroupsAdd/$1/$2', ['filter' => 'role:admin']);

$routes->get('/groupsusers/index/(:any)/(:any)', 'Admin\CGroupsUsers::index/$1/$2', ['filter' => 'role:admin']);
$routes->post('/groupsusers/edit/(:any)/(:any)', 'Admin\CGroupsUsers::rubah/$1/$2', ['filter' => 'role:admin']);

$routes->get('/module/index/(:any)/(:any)', 'Admin\CModule::index/$1/$2', ['filter' => 'role:admin']);
$routes->post('/module/tambah/(:any)/(:any)', 'Admin\CModule::tambah/$1/$2', ['filter' => 'role:admin']);
$routes->post('/module/edit/(:any)/(:any)', 'Admin\CModule::rubah/$1/$2', ['filter' => 'role:admin']);
$routes->post('/module/hapus/(:any)/(:any)', 'Admin\CModule::hapus/$1/$2', ['filter' => 'role:admin']);

$routes->get('/menu/index/(:any)/(:any)', 'Admin\CMenu::index/$1/$2', ['filter' => 'role:admin']);
$routes->post('/menu/tambah/(:any)/(:any)', 'Admin\CMenu::tambah/$1/$2', ['filter' => 'role:admin']);
$routes->post('/menu/edit/(:any)/(:any)', 'Admin\CMenu::rubah/$1/$2', ['filter' => 'role:admin']);
$routes->post('/menu/hapus/(:any)/(:any)', 'Admin\CMenu::hapus/$1/$2', ['filter' => 'role:admin']);
$routes->get('/menu/json/', 'Admin\CMenu::JSONMenu', ['filter' => 'role:admin']);
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
