<?php
$routes->group("Orders", ["namespace" => "\Modules\Orders\Controllers"], function($routes){
    $routes->post('', 'Orders::create');
    $routes->get('Search', 'Orders::search');
    $routes->get('(:segment)', 'Orders::show/$1');
    $routes->put('(:segment)', 'Orders::update/$1');
    $routes->delete('(:segment)', 'Orders::delete/$1');
    $routes->options('(:segment)', 'Orders::delete/$1');
});