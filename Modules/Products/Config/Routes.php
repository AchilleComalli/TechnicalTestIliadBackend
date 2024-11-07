<?php
$routes->group('', ["namespace" => "\Modules\Products\Controllers"], function($routes){
    $routes->get('Products', 'Products::index');
});