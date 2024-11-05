<?php
$routes->group("Orders", ["namespace" => "\Modules\Orders\Controllers"], function($routes){
    $routes->get('Search', 'Orders::search');
    $routes->get('(:segment)', 'Orders::show/$1');
});