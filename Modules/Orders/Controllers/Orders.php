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
                        $from_date = DateTime::createFromFormat('d-m-Y H:i:s', $filterValue . ' 00:00:00');
                        $data = $data->where('date >=', $from_date->format('Y-m-d H:i:s'));
                        break;
                    case 'toDate':
                        $to_date = DateTime::createFromFormat('d-m-Y H:i:s', $filterValue . ' 23:59:59');
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
        return $this->respond(['data' => $result, 'message' => null], 200);
    }


    public function show($id = null){
        $order = (new Order())->where('id', $id)->first();
        if (!is_null($order)) {
            $order['products'] = (new ProductOrder())
                ->select('products.*')
                ->join('products', 'products_orders.product_id = products.id')
                ->where('order_id', $id)
                ->findAll();
            return $this->respond(['data' => $order, 'message' => null], 200);
        }
        return $this->respond(['data' => [], 'message' => 'Not Found'], 404);
    }
}