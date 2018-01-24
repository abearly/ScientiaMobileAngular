<?php

namespace App\Http;

use App\Order;
use App\Http\Response\ApiResponse;
use Exception;

class OrderRepository
{
    protected $file;
    protected $orders;

    public function __construct()
    {
        $path = storage_path();
        $this->file = $path.'/orders.json';

        $json = file_get_contents($this->file);
        if (!$json) {
            throw new Exception('');
        }

        $this->orders = [];
        $orders = json_decode($json);

        foreach ($orders as $order) {
            $data = [
                'id' => $order->id,
                'when' => $order->when,
                'product_id' => $order->product_id,
            ];

            $this->orders[] = new Order($data, $order->product_id);
        }
        if (!empty($this->orders)) {
            usort($this->orders, array($this, "cmp"));
        }
    }

    private function cmp($a, $b)
    {
        return strcmp($a->when, $b->when);
    }

    public function getOrders()
    {
        return $this->orders;
    }

    public function getNewId()
    {
        $last_id = 0;
        foreach ($this->orders as $order) {
            if ($order['id'] > $last_id) {
                $last_id = $order['id'];
            }
        }
        $last_id++;
        return $last_id;
    }

    public function addToOrders($order) {
        $this->orders[] = $order;
    }

    public function clearOrders()
    {
        $this->orders = [];
    }

    public function saveOrders($respond = true)
    {
        $response = ApiResponse::instance();
        if (!file_put_contents($this->file, json_encode($this->orders))) {
            $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
            $response->success = false;
            $response->data = [];
            $response->message = "Could not save orders";
            return $response->send();
        }
        if ($respond) {
            $response->status = ApiResponse::STATUS_CODE_OK;
            $response->success = true;
            $response->data = $this->orders;
            $response->message = "Saved!";
            return $response->send();
        }
        return;
    }
}
