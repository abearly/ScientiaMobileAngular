<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\ProductRepository;

class Product extends Model
{
    protected $fillable = ['id', 'name', 'price'];

    public function __construct($attributes)
    {
        parent::__construct($attributes);
    }
}
