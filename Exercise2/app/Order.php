<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\ProductRepository;
use App\Http\OrderRepository;

class Order extends Model
{
    protected $fillable = ['id', 'when', 'product_id'];
    protected $product;

    public function __construct($attributes, $product_id)
    {
        parent::__construct($attributes);
        $repo = new ProductRepository();
        $this->product = $repo->findById($product_id);
    }
}
