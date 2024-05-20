<?php

use App\Livewire\CartPage;
use App\Livewire\HomePage;
use App\Livewire\CancelPage;
use App\Livewire\SuccesPage;
use App\Livewire\CheckoutPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\ProductsPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\CategoriesPage;
use App\Livewire\DetailOrderPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\ProductDetailPage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\Auth\ForgotPasswordPage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomePage::class)->name('home');
Route::get('/categories', CategoriesPage::class);
Route::get('/products', ProductsPage::class);
Route::get('/cart', CartPage::class);
Route::get('/products/{slug}', ProductDetailPage::class);




Route::middleware('auth')->group(function () {
    Route::get('logout', function () {
        auth()->logout();
        return redirect()->to('/');
    });
    
    Route::get('/success', SuccesPage::class)->name('success');
    Route::get('/cancel', CancelPage::class)->name('cancel');

    Route::get('/checkout', CheckoutPage::class);
    Route::get('/my-orders', MyOrdersPage::class);
    Route::get('/my-orders/{order_id}', DetailOrderPage::class)->name('my-orders.show');

});

Route::middleware('guest')->group(function () {
    // Auth
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class);
    Route::get('/forgot', ForgotPasswordPage::class)->name('password.request');
    Route::get('/reset/{token}', ResetPasswordPage::class)->name('password.reset');
});

Route::get('phpinfo', fn () => phpinfo());


