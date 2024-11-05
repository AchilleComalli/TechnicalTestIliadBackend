<?php

namespace Modules\ProductsOrders\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsOrdersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'product_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'null' => false,
            ],
            'order_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'null' => false,
            ],
            'created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'deleted_at TIMESTAMP NULL DEFAULT NULL'
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'NO ACTION', 'NO ACTION');
        $this->forge->addForeignKey('order_id', 'orders', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('products_orders');
    }

    public function down()
    {
        $this->forge->dropTable('products_orders');
    }
}
