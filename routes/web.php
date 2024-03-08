<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductControllers;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Session;

Route::get('/', [ProductControllers::class, 'index'])->middleware('apiauth');

Route::get('/order', [ProductControllers::class, 'shipping'])->name('order.shipping');

Route::post('/completed', [OrderController::class, 'order'])->name('order.create');

Route::get('/completed-order', [OrderController::class, 'showCompletedOrder'])->name('order.completed');

Route::get('/orderCompleted/{order_id}', [OrderController::class, 'orderCompleted'])->name('order.completed1');

Route::post('/add-to-cart/{product}', [ProductControllers::class, 'addToCart'])->name('product.addToCart');

Route::post('/update-quantity', [ProductControllers::class, 'updateQuantity'])->name('update-quantity');

Route::get('/abort', function(){
    return view('error');
});
