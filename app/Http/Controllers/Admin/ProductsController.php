<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreRequest;
use App\Http\Requests\Admin\Products\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Utilities\ImageUploader;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.add', compact('categories'));
    }

    public function store(StoreRequest $request)
    {
        // اعتبارسنجی داده‌ها
        $validatedData = $request->validated();

        // آپلود تصویر با توجه به category_id
        $imagePath = null;
        if ($request->hasFile('image_path') && $request->file('image_path')->isValid()) {
            $categoryId = $validatedData['category_id'];
            $uploadFolder = 'products/' . $categoryId; // مسیر پوشه بر اساس category_id
            $imagePath = ImageUploader::upload($request->file('image_path'), $uploadFolder); // آپلود تصویر
        }

        // ایجاد و ذخیره اطلاعات محصول در پایگاه داده
        $product = Product::create([
            'name' => $validatedData['name'],
            'brand' => $validatedData['brand'],
            'price' => $validatedData['price'],
            'quntity' => $validatedData['quntity'],
            'discount' => $validatedData['discount'],
            'limited' => $validatedData['limited'],
            'description' => $validatedData['description'],
            'category_id' => $validatedData['category_id'],
            'image_path' => $imagePath, // ذخیره مسیر تصویر
        ]);

        return redirect()->route('admin.products.create')->with('success', 'محصول با موفقیت ذخیره شد.');
    }
    public function all(Request $request)
    {
        $query = $request->input('query');
        $noStock = $request->has('no_stock'); // بررسی وضعیت چک‌باکس

        $products = Product::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', "%{$query}%");
        })->when($noStock, function ($queryBuilder) {
            return $queryBuilder->where('quntity', '<=', 0);
        })->paginate(10);

        return view('admin.products.all', compact('products'));
    }
    public function delete($product_id)
    {
        $product = Product::findOrFail($product_id);
        $product->delete();
        return back()->with('success', 'محصول حذف شد');
    }
    public function edit($product_id)
    {
        $categories = Category::all();

        $product = Product::findOrFail($product_id);
        return view('admin.products.edit', compact('product', 'categories'));
    }
    public function update(UpdateRequest $request, $product_id)
    {
        $validatedData = $request->validated();
        $product = Product::findOrFail($product_id);
        $imagePath = $product->image_path;
        if ($request->hasFile('image_path') && $request->file('image_path')->isValid()) {
            $categoryId = $validatedData['category_id'];
            $uploadFolder = 'products/' . $categoryId; // مسیر پوشه بر اساس category_id
            $imagePath = ImageUploader::upload($request->file('image_path'), $uploadFolder); // آپلود تصویر
        }
        $updatedProduct = $product->update([
            'name' => $validatedData['name'],
            'brand' => $validatedData['brand'],
            'price' => $validatedData['price'],
            'quntity' => $validatedData['quntity'],
            'discount' => $validatedData['discount'],
            'limited' => $validatedData['limited'],
            'description' => $validatedData['description'],
            'category_id' => $validatedData['category_id'],
            'image_path' => $imagePath, // ذخیره مسیر تصویر

        ]);
        if (!$updatedProduct) {
            return back()->with('failed', 'محصول بروزرسانی نشد');
        }
        return back()->with('success', 'محصول بروزرسانی شد');
    }
}
