<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;


Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['lv', 'en'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');


Auth::routes([
    'reset'   => false,
    'confirm' => false,
    'verify'  => false,
]);

Route::get('/logout', [LoginController::class, 'logout'])->name('get-logout');


Route::middleware(['auth', 'check_banned'])->group(function () {

    
    Route::prefix('person')->as('person.')->group(function () {
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });

    
    Route::prefix('admin')
        ->middleware(['is_admin'])
        ->as('admin.')
        ->group(function () {

            
            Route::resource('categories', CategoryController::class)->names([
                'index'   => 'categories.index',
                'create'  => 'categories.create',
                'store'   => 'categories.store',
                'show'    => 'categories.show',
                'edit'    => 'categories.edit',
                'update'  => 'categories.update',
                'destroy' => 'categories.destroy',
            ]);

            
            Route::resource('products', ProductController::class)->names([
                'index'   => 'products.index',
                'create'  => 'products.create',
                'store'   => 'products.store',
                'show'    => 'products.show',
                'edit'    => 'products.edit',
                'update'  => 'products.update',
                'destroy' => 'products.destroy',
            ]);

            
            Route::get('users/control', [UserController::class, 'index'])->name('users.control');
            Route::post('users/{user}/toggle-ban', [UserController::class, 'toggleBan'])->name('users.toggle-ban');
        });

    
    Route::get('/home', function () {
        return redirect()->route('person.orders.index');
    })->name('home');
});


Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/categories', [MainController::class, 'categories'])->name('categories'); // publiskais


Route::prefix('basket')->group(function () {
    Route::post('add/{id}', [BasketController::class, 'basketAdd'])->name('basket-add');

    Route::middleware('basket_not_empty')->group(function () {
        Route::get('/', [BasketController::class, 'basket'])->name('basket');
        Route::get('place', [BasketController::class, 'basketPlace'])->name('basket-place');
        Route::post('remove/{id}', [BasketController::class, 'basketRemove'])->name('basket-remove');
        Route::post('place', [BasketController::class, 'basketConfirm'])->name('basket-confirm');
    });
});


Route::get('/{category:code}/{product:code}', [MainController::class, 'product'])->name('product');
Route::get('/{category:code}', [MainController::class, 'category'])->name('category');
