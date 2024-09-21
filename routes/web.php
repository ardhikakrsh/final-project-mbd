<?php

use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\KendaraanController;
use App\Http\Controllers\admin\PembayaranController;
use App\Http\Controllers\admin\PengembalianController;
use App\Http\Controllers\admin\SewaController;
use App\Http\Controllers\owner\KendaraanController as ownerKendaraanController;
use App\Http\Controllers\owner\OrderController as ownerOrderController;
use App\Http\Controllers\user\SewaController as userSewaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InfoUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::prefix('/sandbox')->middleware(['auth'])->group(function () {

	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

	Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

	Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

	Route::get('static-sign-up', function () {
		return view('static-sign-up');
	});

	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
	Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});


Route::get('/', [DashboardController::class, 'home']);

Route::group(['middleware' => 'guest'], function () {
	Route::get('/login', [AuthController::class, 'signIn']);
	Route::post('/login', [AuthController::class, 'signInStore']);
	Route::get('/register', [AuthController::class, 'signUp']);
	Route::post('/register', [AuthController::class, 'signUpStore']);
	Route::get('/forgot-password', [AuthController::class, 'forgot']);
	Route::post('/forgot-password', [AuthController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [AuthController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [AuthController::class, 'changePassword'])->name('password.update');
});
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
	Route::get('/user-profile', [InfoUserController::class, 'index']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
	Route::get('/{kendaraan}', [DashboardController::class, 'detail'])->name('detail');
	Route::post('/', [DashboardController::class, 'store'])->name('storeOrder');
});

Route::prefix('/admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
	Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
	Route::resource('/users', UserController::class);
	Route::resource('/kendaraans', KendaraanController::class);
	Route::resource('/orders', SewaController::class);
	Route::resource('/pembayarans', PembayaranController::class);
	Route::resource('/pengembalians', PengembalianController::class);
	Route::post('/pembayarans/{pembayaran}/verify', [PembayaranController::class, 'verify'])->name('pembayarans.verify');
	ROute::post('/orders/{order}/verify', [SewaController::class, 'verify'])->name('orders.verify');

});

Route::prefix('/owner')->middleware(['auth', 'role:owner'])->name('owner.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'owner'])->name('dashboard');
    Route::resource('/kendaraan', ownerKendaraanController::class);
    Route::resource('/order', ownerOrderController::class);
});


Route::prefix('/user')->middleware(['auth', 'role:user'])->name('user.')->group(function () {
	Route::get('/dashboard', [DashboardController::class, 'user'])->name('dashboard');
	Route::resource('/order', userSewaController::class);
	Route::get('/order/{id}/payment', [userSewaController::class, 'bayar'])->name('order.pay');
	Route::post('/order/{id}/payment', [userSewaController::class, 'store'])->name('order.payment');
});
