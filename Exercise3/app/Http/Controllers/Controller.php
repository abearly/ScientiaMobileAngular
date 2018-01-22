<?php

namespace App\Http\Controllers;

date_default_timezone_set('America/New_York');

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Response\ApiResponse;
use Illuminate\Http\Request;
use App\Product;
use App\Order;

use App\Http\ProductRepository;
use App\Http\OrderRepository;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getView($view)
    {
        return view($view);
    }
}
