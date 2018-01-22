<?php

namespace App\Http\Controllers;

date_default_timezone_set('America/New_York');

use Illuminate\Routing\Controller as BaseController;
use App\Http\Response\ApiResponse;
use Illuminate\Http\Request;
use App\Product;
use App\Http\ProductRepository;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function get()
    {
        $repo = new ProductRepository();
        $response = ApiResponse::instance();
        $response->status = ApiResponse::STATUS_CODE_OK;
        $response->success = true;
        $response->data = $repo->getProducts();
        $response->message = "Products";
        return $response->send();
    }

    private function validateProduct($repo, $item)
    {
        $response = ApiResponse::instance();
        if (!array_key_exists('id', $item)) {
            $item['id'] = -1;
        }

        if (!array_key_exists('name', $item) || !$item['name'] || $item['name'] === '') {
            $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
            $response->success = false;
            $response->data = [];
            $response->message = "Missing product name";
            return $response->send();
        }

        if (!$repo->validateUniqueName($item['id'], $item['name'])) {
            $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
            $response->success = false;
            $response->data = [];
            $response->message = "Product name is not unique";
            return $response->send();
        }

        if (!array_key_exists('price', $item) || !$item['price'] || $item['price'] === '') {
            $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
            $response->success = false;
            $response->data = [];
            $response->message = "Missing product price";
            return $response->send();
        }

        if (!is_int($item['price']) || $item['price'] < 1) {
            $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
            $response->success = false;
            $response->data = [];
            $response->message = "Invalid price";
            return $response->send();
        }
    }

    public function addProduct(Request $request)
    {
        $response = ApiResponse::instance();
        $item = $request->input('item');

        $repo = new ProductRepository();

        $this->validateProduct($repo, $item);

        $products = $repo->getProducts();

        $last_id = 0;
        foreach ($products as $product) {
            if ($product->id > $last_id) {
                $last_id = $product->id;
            }
        }
        $last_id++;
        $item['id'] = $last_id;
        $products[] = new Product($item);

        $repo->saveProducts($products);
    }

    public function editProduct(Request $request)
    {
        $response = ApiResponse::instance();
        $item = $request->input('item');

        $repo = new ProductRepository();

        $this->validateProduct($repo, $item);

        $products = $repo->getProducts();

        foreach ($products as $product) {
            if ($product->id == $item['id']) {
                $product->name = $item['name'];
                $product->price = $item['price'];
                break;
            }
        }
        $repo->saveProducts($products);
    }

    public function removeProduct(Request $request)
    {
        $response = ApiResponse::instance();
        $item = $request->input('item');

        $repo = new ProductRepository();

        $products = $repo->getProducts();

        $index = false;
        foreach ($products as $key => $product) {
            if ($product->id == $item['id']) {
                $index = $key;
                break;
            }
        }

        if (!$index) {
            $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
            $response->success = false;
            $response->data = [];
            $response->message = "Could not remove products";
            return $response->send();
        }

        unset($products[$index]);
        $repo->saveProducts($products);
    }
}
