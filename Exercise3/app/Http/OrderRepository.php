<?php

namespace App\Http;

use App\Order;
use App\Http\Response\ApiResponse;
use Exception;
use App\Http\ProductRepository;

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
                'fulfilled' => isset($order->fulfilled) ? $order->fulfilled : false,
                'user_id' => $order->user_id,
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

    public function addToOrders($order)
    {
        $this->orders[] = $order;
    }

    public function removeFromOrders($id)
    {
        foreach ($this->orders as $key => $order) {
            if ($order->id === $id) {
                unset($this->orders[$key]);
            }
        }
    }

    public function saveOrders()
    {
        $response = ApiResponse::instance();

        if (!file_put_contents($this->file, json_encode($this->orders))) {
            $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
            $response->success = false;
            $response->data = [];
            $response->message = "Could not save orders";
            return $response->send();
        }

        $product_repo = new ProductRepository();
        foreach ($this->orders as $order) {
            $order->product = $product_repo->findById($order->product_id);
        }
        $response->status = ApiResponse::STATUS_CODE_OK;
        $response->success = true;
        $response->data = $this->orders;
        $response->message = "Saved!";
        return $response->send();
    }
}
