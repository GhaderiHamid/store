<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreRequest;
use App\Http\Requests\Admin\Categories\UpdateRequest;
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
        $validatedData = $request->validated();
        $createCateory = Category::create([
            'category_name' => $validatedData['category_name'],
        ]);
        if (!$createCateory) {
            return back()->with('fail', 'دسته‌بندی ایجاد نشد');
        }

        return back()->with('success', 'دسته‌بندی ایجاد شد');
    }
    public function all()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.all', compact('categories'));
    }
    public function home()
    {
        return view('admin.index');
    }
    public function delete($category_id)
    {
        // پیدا کردن دسته‌بندی بر اساس category_id
        $category = Category::where('id', $category_id)->first();

        // بررسی وجود دسته‌بندی
        if (!$category) {
            return redirect()->back()->with('error', 'دسته‌بندی مورد نظر پیدا نشد.');
        }

        // حذف دسته‌بندی
        $category->delete();

        return redirect()->route('admin.categories.all')->with('success', 'دسته‌بندی با موفقیت حذف شد.');
    }
    public function edit($category_id){
        $category = Category::find($category_id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateRequest $request,$category_id){
       $validatedData = $request->validated();
        $category=Category::find($category_id);
        $updatedCategory=$category->update([
        'category_name'=>$validatedData ['category_name'],
       ]);
       
        if(!$updatedCategory){
            return back()->with('failed', 'دسته بندی بروزرسانی نشد');
        }
                    return back()->with('success', 'دسته بندی بروزرسانی شد');

    }
}
