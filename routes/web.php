<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

Route::get('/lang/{locale}', function ($locale) {
     if (in_array($locale, ['lv', 'en'])) {
         Session::put('locale', $locale);
     }
     return redirect()->back();
 })->name('lang.switch');
// 1) Autentifikācija
Auth::routes([
    'reset'   => false,
    'confirm' => false,
    'verify'  => false,
]);

Route::get('/logout', [LoginController::class,'logout'])
     ->name('get-logout');


// 2) Personīgais (autorizēti lietotāji)
Route::middleware('auth')->group(function(){
    Route::prefix('person')
         ->as('person.')
         ->group(function(){
             Route::get('orders',       [OrderController::class,'index'])
                  ->name('orders.index');
             Route::get('orders/{order}',[OrderController::class,'show'])
                  ->name('orders.show');
         });

    // Admins saviem resursiem
    Route::prefix('admin')
         ->middleware('is_admin')
         ->group(function(){
             Route::resource('categories', CategoryController::class);
             Route::resource('products',   ProductController::class);
         });
});

// 3) Home → pāradresē uz person.orders.index
Route::get('/home', function(){
    return redirect()->route('person.orders.index');
})->middleware('auth')
  ->name('home');


// 4) Publiskā daļa
Route::get('/',                [MainController::class,'index'])->name('index');
Route::get('/categories',      [MainController::class,'categories'])->name('categories');

Route::prefix('basket')->group(function(){
    Route::post('add/{id}', [BasketController::class,'basketAdd'])
         ->name('basket-add');
    Route::middleware('basket_not_empty')->group(function(){
        Route::get('/',     [BasketController::class,'basket'])
             ->name('basket');
        Route::get('place',[BasketController::class,'basketPlace'])
             ->name('basket-place');
        Route::post('remove/{id}', [BasketController::class,'basketRemove'])
             ->name('basket-remove');
        Route::post('place', [BasketController::class,'basketConfirm'])
             ->name('basket-confirm');
    });
});

// 5) Produktu apskate un kategorijas — šie ir wildcard, liekams pašā beigās
// šīs divas rindas PĒC visa cita routes/web.php beigās:

// 1) VISpirms produkts ar code–code
Route::get('/{category:code}/{product:code}', [MainController::class,'product'])
     ->name('product');

// 2) tikai pēc tam vienkārša kategorija
Route::get('/{category:code}', [MainController::class,'category'])
     ->name('category');

    

