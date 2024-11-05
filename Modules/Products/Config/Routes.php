<?php
$routes->group("Products", ["namespace" => "\Modules\Products\Controllers"], function($routes){
    $routes->get('', 'Products::index');
});