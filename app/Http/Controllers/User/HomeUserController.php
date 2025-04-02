<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeUserController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('frontend.home.all',compact('categories'));
    }
   
}
