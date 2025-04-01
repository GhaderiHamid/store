<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function all()
    {
        return view('frontend.product.all');
    }
    public function single(){
        return view('frontend.product.single');
    }
}
