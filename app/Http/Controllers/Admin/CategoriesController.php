<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function create()
    {
        return view('admin.categories.create');
    }
    public function store(StoreRequest $request)
    {
       $validatedData= $request->validated();
       $createCateory=Category::create([
            'category_name'=>$validatedData['category_name'],
        ]);
        if (!$createCateory) {
            return back()->with('fail', 'دسته‌بندی ایجاد نشد');
        }
        
        return back()->with('success', 'دسته‌بندی ایجاد شد');
        
        
    }
    public function all(){
        $categories=Category::all();
        return view('admin.categories.all',compact('categories'));
    }
    public function home(){
        return view('admin.index');
    }
}
