<?php

namespace Config;

require_once SYSTEMPATH . 'Config/AutoloadConfig.php';

/**
 * -------------------------------------------------------------------
 * AUTO-LOADER
 * -------------------------------------------------------------------
 * This file defines the namespaces and class maps so the Autoloader
 * can find the files as needed.
 */
class Autoload extends \CodeIgniter\Config\AutoloadConfig
{
    public $psr4 = [
        APP_NAMESPACE => APPPATH,                // For custom namespace
        'Config'      => APPPATH . 'Config',
        'Modules'	  => ROOTPATH . 'Modules',
        'Modules\Products' => ROOTPATH . 'Modules/Products',
        'Modules\Orders' => ROOTPATH . 'Modules/Orders',
        'Modules\ProductsOrders' => ROOTPATH . 'Modules/ProductsOrders',
    ];

    public $classmap = [];
}
