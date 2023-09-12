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
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\tiketAjaxControllet;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\UserController;
use App\Models\Patient;
use App\Models\Poly;


Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');

Route::post('/create-antrian', [PatientController::class, 'store'])->name('tambah-antrian');
Route::post('/test-suara', [PatientController::class, 'testing'])->name('test-suara');

Route::middleware(['auth', 'admin'])->group(function () {
    //Dashboard Route
    Route::get('/dashboard', [AdminController::class, 'index'])->name('home');
    Route::get('/setting-admin', [AdminController::class, 'viewAdmin'])->name('setAdmin');
    Route::get('/create-admin', [AdminController::class, 'createAdmin'])->name('createAdmin');
    Route::post('/store-admin', [AdminController::class, 'storeAdmin'])->name('storeAdmin');
    Route::post('/delete-admin/{id}', [AdminController::class, 'deleteAdmin'])->name('deleteAdmin');


    Route::get('/setting-user', [AdminController::class, 'viewUser'])->name('setUser');
    Route::get('/create-user', [AdminController::class, 'createUser'])->name('createUser');
    Route::post('/store-user', [AdminController::class, 'storeUser'])->name('storeUser');
    Route::get('/details-user/{id}', [AdminController::class, 'detailsUser'])->name('detailsUser');
    Route::post('/update-user/{id}', [AdminController::class, 'updateUser'])->name('updateUser');
    Route::post('/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');

    Route::get('/setting-doktor', [AdminController::class, 'viewDoktor'])->name('setDoktor');
    Route::get('/create-doktor', [AdminController::class, 'createDoktor'])->name('createDoktor');
    Route::post('/store-doktor', [AdminController::class, 'storeDoktor'])->name('storeDoktor');
    Route::get('/details-doktor/{id}', [AdminController::class, 'detailsDoktor'])->name('detailsDoktor');
    Route::post('/update-doktor/{id}', [AdminController::class, 'updateDoktor'])->name('updateDoktor');
    Route::post('/delete-doktor/{id}', [AdminController::class, 'deleteDoktor'])->name('deleteDoktor');

    Route::get('/setting-poli', [AdminController::class, 'viewPoli'])->name('setPoli');
    Route::get('/create-poli', [AdminController::class, 'createPoli'])->name('createPoli');
    Route::post('/store-poli', [AdminController::class, 'storePoli'])->name('storePoli');
    Route::get('/details-poli/{id}', [AdminController::class, 'detailsPoli'])->name('detailsPoli');
    Route::post('/update-poli/{id}', [AdminController::class, 'updatePoli'])->name('updatePoli');
    Route::post('/delete-poli/{id}', [AdminController::class, 'deletePoli'])->name('deletePoli');

    Route::put('/set-monitorVideo', [AdminController::class, 'setVidMonitor'])->name('setVidMonitor');
});

//DOKTOR LOGIN DAN SELESAI ( ARYA )!!
Route::middleware(['auth', 'doktor'])->group(function () {
    // Route::get('/user', [UserController::class, 'index'])->name('userIndex');
    Route::get('/doctor', [DoktorController::class, 'index'])->name('dokAntrian');
    Route::post('/getAntrian/{patient:antrian}', [DoktorController::class, 'getAntrian'])->name('ambil-antrian');
    Route::post('/deleteAntrian/{patient:antrian}', [DoktorController::class, 'deleteAntrian'])->name('hapus-antrian');
    Route::post('/nextAntrian/{patient:antrian}', [DoktorController::class, 'nextAntrian'])->name('antrian-selanjutnya');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/tiket', function () {
        return view('tiket.welcome', [
            'polies' => Poly::all()
        ]);
    })->name('tiket');
    Route::post('/tiket', [tiketAjaxControllet::class, 'masuk']);
    Route::get('/get-polie', [tiketAjaxControllet::class, 'index']);
    Route::post('/tiketAjax', [tiketAjaxControllet::class, 'coba'])->name('create-antrian');
    Route::get('/testevent', [DoktorController::class, 'testing']);
    // Route::get('/monitor', function () {
    //     return view('Monitor.welcome', [
    //         'poly' => Poly::paginate(4)
    //     ]);
    // })->name('monitor');
    Route::get('/monitor', [MonitorController::class, 'index'])->name('monitor');
    Route::get('/user', [UserController::class, 'index'])->name('userIndex');
    Route::get('profile', [UserProfileController::class, 'show'])->name('profile');

    Route::get('/', function () {
        return redirect()->route('profile');
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
