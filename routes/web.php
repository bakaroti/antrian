<?php

use App\Events\NomorEvent;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
// 	return view('welcome');
// });

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\DoktorController;
use App\Http\Controllers\monitorAjaxController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\tiketAjaxControllet;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\UserController;
use App\Models\Patient;
use App\Models\Poly;

// Route::get('/', function () {
// 	return redirect('/dashboard');
// })->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');

Route::post('/create-antrian', [PatientController::class, 'store'])->name('tambah-antrian');

Route::middleware(['auth', 'admin'])->group(function () {
    //Dashboard Route
    Route::get('/dashboard', [AdminController::class, 'index'])->name('home');
    Route::get('/setting-user', [AdminController::class, 'viewUser'])->name('setUser');
    Route::resource('SettingUser', SettingUserController::class);
    Route::get('/setting-doktor', [AdminController::class, 'viewDoktor'])->name('setDoktor');
    Route::get('/setting-poli', [AdminController::class, 'viewPoli'])->name('setPoli');
});

Route::middleware(['auth'])->group(function () {
    //Dashboard Route
    //doktor

    Route::get('/doctor', [DoktorController::class, 'index']);

    Route::get('/tiket', function () {
        return view('tiket.welcome', [
            'polies' => Poly::all()
        ]);
    });
    Route::post('/tiket', [tiketAjaxControllet::class, 'masuk']);

    Route::get('/get-polie', [tiketAjaxControllet::class, 'index']);
    Route::post('/tiketAjax', [tiketAjaxControllet::class, 'coba'])->name('create-antrian');

    Route::get('/testevent', [DoktorController::class, 'testing']);
    Route::get('/monitor', function () {
        return view('Monitor.welcome', [
            'poly' => Poly::paginate(4)
        ]);
    });
    //Route::get('/user', [UserController::class, 'index'])->name('userIndex');
    Route::view('/antrian', 'mainDoktor.index');

    Route::post('/getAntrian/{patient:antrian}', [DoktorController::class, 'getAntrian'])->name('ambil-antrian');
    Route::post('/deleteAntrian/{patient:antrian}', [DoktorController::class, 'deleteAntrian'])->name('hapus-antrian');
    Route::post('/nextAntrian/{patient:antrian}', [DoktorController::class, 'nextAntrian'])->name('antrian-selanjutnya');

    Route::get('/antrian-send', [DoktorController::class, 'index'])->name('dokAntrian');

    Route::get('/', function () {
        return redirect()->route('userIndex');
    });
});


//TESTING JANGAN DI UBAH!!
Route::middleware(['auth'])->group(function () {
    // Route::get('user', function () {
    // 	return view('mai.index');
    // })->name('userIndex');
    Route::get('virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
    Route::get('rtl', [PageController::class, 'rtl'])->name('rtl');
    Route::get('profile', [UserProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::get('profile-static', [PageController::class, 'profile'])->name('profile-static');
    Route::get('sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
    Route::get('sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
    Route::get('{page}', [PageController::class, 'index'])->name('page');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});



// Route::group(['middleware' => 'auth'], function () {
// 	Route::get('user', function () {
// 		return view('user.index');
// 	})->name('userIndex');
// 	Route::get('virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
// 	Route::get('rtl', [PageController::class, 'rtl'])->name('rtl');
// 	Route::get('profile', [UserProfileController::class, 'show'])->name('profile');
// 	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
// 	Route::get('profile-static', [PageController::class, 'profile'])->name('profile-static');
// 	Route::get('sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
// 	Route::get('sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
// 	Route::get('{page}', [PageController::class, 'index'])->name('page');
// 	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
// });
