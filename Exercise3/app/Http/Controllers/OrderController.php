<?php

namespace App\Http\Controllers;

date_default_timezone_set('America/New_York');

use Illuminate\Routing\Controller as BaseController;
use App\Http\Response\ApiResponse;
use Illuminate\Http\Request;
use App\Order;
use App\Http\ProductRepository;
use App\Http\OrderRepository;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function get()
    {
        $response = ApiResponse::instance();
        $repo = new OrderRepository();
        $product_repo = new ProductRepository();
        $orders = $repo->getOrders();
        foreach ($orders as $order) {
            $order->product = $product_repo->findById($order->product_id);
        }
        $response->status = ApiResponse::STATUS_CODE_OK;
        $response->success = true;
        $response->data = $orders;
        $response->message = "Orders";
        return $response->send();
    }

    public function submitOrder(Request $request)
    {
        $cart = $request->input('cart');
        $user_id = $request->input('user_id');

        $repo = new OrderRepository();
        $orders = $repo->getOrders();
        $next_id = $repo->getNewId();

        foreach ($cart as $item) {
            $data = [
                'id' => $next_id,
                'when' => date('Y-m-d H:i:s'),
                'product_id' => $item['id'],
                'fulfilled' => 0,
            ];
            if ($user_id) {
                $data['user_id'] = $user_id;
            } else {
                $data['user_id'] = null;
            }
            $order = new Order($data, $item['id']);
            $repo->addToOrders($order);
            $next_id++;
        }
        $repo->saveOrders();
    }

    public function fulfill(Request $request)
    {
        $id = $request->input('id');

        $repo = new OrderRepository();
        $orders = $repo->getOrders();

        foreach ($orders as $order) {
            if ($order->id === $id) {
                $order->fulfilled = true;
                break;
            }
        }
        $repo->saveOrders();
    }

    public function cancelOrder(Request $request)
    {
        $id = $request->input('id');

        $repo = new OrderRepository();
        $repo->removeFromOrders($id);
        $repo->saveOrders();
    }
}
