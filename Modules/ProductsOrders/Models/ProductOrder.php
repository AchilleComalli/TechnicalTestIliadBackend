<?php

namespace Modules\ProductsOrders\Models;

use CodeIgniter\Model;

class ProductOrder extends Model
{
    protected $table = 'products_orders';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'product_id',
        'order_id',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
