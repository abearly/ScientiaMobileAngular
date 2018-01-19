<?php

namespace App\Http;

use App\Product;
use App\Http\Response\ApiResponse;

class ProductRepository
{
    protected $available_products;
    protected $file;

    public function __construct()
    {
        $path = storage_path();
        $this->file = $path.'/products.json';
        $json = file_get_contents($this->file);
        if (!$json) {
            throw new Exception();
        }
        $products = json_decode($json);

        foreach ($products as $product) {
            $data = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
            ];
            $this->available_products[] = new Product($data);
        }
    }

    public function getProducts()
    {
        return $this->available_products;
    }

    public function findById($id)
    {
        $products = $this->getProducts();
        foreach ($products as $product) {
            if ($product->id === $id) {
                return $product;
            }
        }
        return false;
    }


    public function addProduct(Request $request)
    {
        $name = $request->input('name');
        $price = $request->input('price');

        $this->available_products[] = new Product(['name' => $name, 'price' => $price]);
    }

    public function saveProducts($products)
    {
        $response = ApiResponse::instance();
        $this->available_products = $products;
        if (!file_put_contents($this->file, json_encode($products))) {
            $response->status = ApiResponse::STATUS_CODE_INVALID_INPUT;
            $response->success = false;
            $response->data = [];
            $response->message = "Could not save products";
            return $response->send();
        }

        $response->status = ApiResponse::STATUS_CODE_OK;
        $response->success = true;
        $response->data = $products;
        $response->message = "Saved!";
        return $response->send();
    }

    public function validateUniqueName($id, $name) {
        foreach ($this->available_products as $product) {
            if ($product['name'] === $name && $product['id'] !== $id) {
                return false;
            }
        }
        return true;
    }
}
