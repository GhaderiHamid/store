<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreRequest;
use App\Models\Category;
use App\Models\Product;
use App\Utilities\ImageUploader;

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
        'price' => $validatedData['price'],
        'description' => $validatedData['description'],
        'category_id' => $validatedData['category_id'],
        'image_path' => $imagePath, // ذخیره مسیر تصویر
    ]);

    return redirect()->route('admin.products.create')->with('success', 'محصول با موفقیت ذخیره شد.');
}
   public function all(){
    $products=Product::paginate(10);
    return view('admin.products.all',compact('products'));
   }
}