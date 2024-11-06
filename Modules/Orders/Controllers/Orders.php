<?php

namespace Modules\Orders\Controllers;

use CodeIgniter\RESTful\ResourceController;
use DateTime;
use Modules\Orders\Models\Order;
use Modules\ProductsOrders\Models\ProductOrder;

class Orders extends ResourceController
{
    protected $modelName = 'Modules\Orders\Models\Order';

    public function search()
    {
        $requestFilters = $this->request->getVar();

        $data = $this->model;

        $allowedFilters = [
            'search',
            'fromDate',
            'toDate',
            'sortField'
        ];

        foreach ($requestFilters as $filterKey => $filterValue) {
            if (in_array($filterKey, $allowedFilters)) {
                switch ($filterKey) {
                    case 'search':
                        $data = $data->groupStart();
                        $data = $data->like('name', $filterValue);
                        $data = $data->orLike('description', $filterValue);
                        $data = $data->groupEnd();
                        break;
                    case 'fromDate':
                        $from_date = DateTime::createFromFormat('m/d/Y H:i:s', $filterValue . ' 00:00:00');
                        $data = $data->where('date >=', $from_date->format('Y-m-d H:i:s'));
                        break;
                    case 'toDate':
                        $to_date = DateTime::createFromFormat('m/d/Y H:i:s', $filterValue . ' 23:59:59');
                        $data = $data->where('date <=', $to_date->format('Y-m-d H:i:s'));
                        break;
                    case 'sortField':
                        $data = $data->orderBy($filterValue, $requestFilters['sortOrder'] ?? 'desc');
                        break;
                }
            }
        }

        $perPage = isset($requestFilters['perPage']) && $requestFilters['perPage'] >= 1 && $requestFilters['perPage'] <= 100 ? $requestFilters['perPage'] : 20;

        $result['data'] = $data->paginate($perPage);
        $result['pagination'] = $data->pager->getDetails();
        return $this->respond($result, 200);
    }


    public function show($id = null)
    {
        $order = (new Order())->where('id', $id)->first();
        if (!is_null($order)) {
            $order['products'] = (new ProductOrder())
                ->select('products.*')
                ->join('products', 'products_orders.product_id = products.id')
                ->where('order_id', $id)
                ->findAll();
            return $this->respond($order, 200);
        }
        return $this->failNotFound();
    }

    public function create()
    {
        $data = $this->request->getVar();

        if (!$this->validate($this->model->validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $order = [
            'name' => $data->name,
            'description' => $data->description,
            'date' => DateTime::createFromFormat('m/d/Y H:i:s', $data->date . ' 00:00:00')->format('Y-m-d H:i:s'),
        ];
        $orderId = $this->model->insert($order);

        if (!$orderId) {
            return $this->failServerError("Errore nella creazione dell'ordine");
        }

        if (isset($data->products) && is_array($data->products)) {
            foreach ($data->products as $product) {
                $orderProduct = (new ProductOrder())->insert(
                    [
                        'order_id' => $orderId,
                        'product_id' => $product,
                    ]
                );
                if (!$orderProduct) {
                    return $this->failServerError("Errore nella creazione dell'ordine");
                }
            }
        }

        return $this->respondCreated(
            [
                'id' => $orderId,
                'name' => $data->name,
                'description' => $data->description,
                'date' => $data->date,
                'products' => $data->products ?? []
            ],
            'Ordine creato con successo'
        );
    }

    public function update($id = null)
    {
        $data = $this->request->getVar();

        if (!$this->validate($this->model->validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $order = (new Order())->where('id', $id)->first();
        if (is_null($order)) {
            return $this->failNotFound();
        }

        $order = [
            'name' => $data->name,
            'description' => $data->description,
            'date' => DateTime::createFromFormat('m/d/Y H:i:s', $data->date . ' 00:00:00')->format('Y-m-d H:i:s'),
        ];
        $result = (new Order())->set($order)->where('id', $id)->update();

        if (!$result) {
            return $this->failServerError("Errore nella modifica dell'ordine");
        }

        (new ProductOrder())->where('order_id', $id)->delete();
        if (isset($data->products) && is_array($data->products)) {
            foreach ($data->products as $product) {
                $orderProduct = (new ProductOrder())->insert(
                    [
                        'order_id' => $id,
                        'product_id' => $product,
                    ]
                );
                if (!$orderProduct) {
                    return $this->failServerError("Errore nella creazione dell'ordine");
                }
            }
        }

        return $this->respondUpdated(
            [
                'id' => $id,
                'name' => $data->name,
                'description' => $data->description,
                'date' => $data->date,
                'products' => $data->products ?? []
            ],
            'Ordine creato con successo'
        );
    }

    public function delete($id = null)
    {
        $order = (new Order())->where('id', $id)->first();
        if (is_null($order)) {
            return $this->failNotFound();
        }
        $result = (new ProductOrder())->where('order_id', $id)->delete();
        if (!$result) {
            return $this->failServerError("Errore durante l'eliminazione", 400);
        }
        $result = (new Order())->where('id', $id)->delete();
        if (!$result) {
            return $this->failServerError("Errore durante l'eliminazione", 400);
        }
        return $this->respondDeleted(null, "Eliminazione avvenuta con successo");
    }
}