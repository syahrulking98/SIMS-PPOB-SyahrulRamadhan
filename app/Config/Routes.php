<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Index::index');
$routes->get('/logout', 'Index::logout');
$routes->post('/login', 'Index::submit');

$routes->get('/registrasi', 'Registrasi::registrasi');
$routes->post('/registrasi', 'Registrasi::submit');

$routes->get('/dashboard', 'Dashboard::dashboard');

$routes->get('/topup', 'Topup::topup');
$routes->post('/topup/process', 'Topup::process');


$routes->get('/service/(:segment)', 'Service::detail/$1');
$routes->post('/service/(:segment)/process', 'Service::process/$1');

$routes->get('/transaction/history', 'Transaction::history');

$routes->get('/profile', 'Profile::profile');
$routes->post('/profile/upload', 'Profile::uploadImage');
$routes->post('/profile/update', 'Profile::updateProfile');
