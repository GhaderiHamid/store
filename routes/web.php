<?php

use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('admin/index',function(){
//        return view('admin.index');
// });
Route::get('admin.index',[CategoriesController::class,'home'])->name('admin.index');


Route::prefix('admin')->group(function(){
   
      Route::prefix('categories')->group(function(){
          Route::get('all',[CategoriesController::class,'all'])->name('admin.categories.all');
          
          Route::get('create',[CategoriesController::class,'create'])->name('admin.categories.create');
          Route::post('',[CategoriesController::class,'store'])->name('admin.categories.store');
      });
});
