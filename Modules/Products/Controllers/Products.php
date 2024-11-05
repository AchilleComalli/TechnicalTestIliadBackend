<?php

namespace Modules\Products\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Products extends ResourceController
{
    protected $modelName = 'Modules\Products\Models\Product';

    public function index(){
       return $this->respond($this->model->findAll(),200);
    }
}