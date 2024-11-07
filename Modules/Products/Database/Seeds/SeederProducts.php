<?php

namespace Modules\Products\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederProducts extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Muffin al Cioccolato',
                'price' => 1.50
            ],
            [
                'name' => 'Kinder Brioss',
                'price' => 1.20
            ],
            [
                'name' => 'Kinder Delice',
                'price' => 1.30
            ],
            [
                'name' => 'Crostatina al Cioccolato',
                'price' => 1.00
            ],
            [
                'name' => 'Fiesta',
                'price' => 1.40
            ],
            [
                'name' => 'Girella',
                'price' => 1.10
            ],
            [
                'name' => 'Plumcake al Limone',
                'price' => 1.20
            ],
            [
                'name' => 'Pan di Stelle',
                'price' => 1.00
            ],
            [
                'name' => 'Yoyo alla Fragola',
                'price' => 0.90
            ],
            [
                'name' => 'Tortina Paradiso',
                'price' => 1.25
            ],
            [
                'name' => 'Tronky',
                'price' => 1.15
            ],
            [
                'name' => 'Ringo',
                'price' => 1.00
            ],
            [
                'name' => 'Twix',
                'price' => 1.30
            ],
            [
                'name' => 'Kinder Bueno',
                'price' => 1.40
            ],
            [
                'name' => 'Ciambella Glassata',
                'price' => 1.00
            ],
            [
                'name' => 'Bounty',
                'price' => 1.30
            ],
            [
                'name' => 'Ciocorì',
                'price' => 1.15
            ],
            [
                'name' => 'KitKat',
                'price' => 1.25
            ],
            [
                'name' => 'Tegolino',
                'price' => 1.10
            ],
            [
                'name' => 'Crostatina all’Albicocca',
                'price' => 1.00
            ],
            [
                'name' => 'Mars',
                'price' => 1.35
            ]
        ];


        // Insert data into the products table
        $this->db->table('products')->insertBatch($data);
    }
}
