<?php

namespace Modules\Orders\Models;

use CodeIgniter\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'description',
        'date',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'description' => 'required|min_length[3]',
        'date' => 'required|valid_date',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Il campo nome è obbligatorio',
            'min_length' => 'Il campo nome deve almeno avere 3 caratteri',
            'max_length' => 'Il campo nome non deve superare i 255 caratteri'
        ],
        'description' => [
            'required' => 'Il campo descrizione è obbligatorio',
            'min_length' => 'Il campo descrizione deve almeno avere 3 caratteri'
        ],
        'date' => [
            'required' => 'Il campo data è obbligatorio',
            'valid_date' => 'Il campo data non è valido'
        ]
    ];
}
