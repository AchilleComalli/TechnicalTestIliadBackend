<?php
$routes->group('', ["namespace" => "\Modules\Orders\Controllers"], function($routes){
    $routes->post('Orders', 'Orders::create');
    $routes->get('Orders/Search', 'Orders::search');
    $routes->get('Orders/(:segment)', 'Orders::show/$1');
    $routes->put('Orders/(:segment)', 'Orders::update/$1');
    $routes->delete('Orders/(:segment)', 'Orders::delete/$1');
});