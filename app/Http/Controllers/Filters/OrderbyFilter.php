<?php

namespace App\Http\Controllers\Filters;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderbyFilter extends Controller
{
    public function newest()
    {
        return Product::orderBy('desc','created_at')->get();
    }
}
