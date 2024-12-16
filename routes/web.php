<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\InformationUserController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AssignmentUserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LocationController;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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


Route::middleware('auth')->group(function () {
    Route::middleware('role:admin,operator')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        // positions
        Route::resource('/positions', PositionController::class)->only(['index', 'create']);
        Route::get('/positions/edit', [PositionController::class, 'edit'])->name('positions.edit');
        // employees
        Route::resource('/employees', EmployeeController::class)->only(['index', 'create']);
        Route::get('/employees/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
        // holidays (hari libur)
        Route::resource('/holidays', HolidayController::class)->only(['index', 'create']);
        Route::get('/holidays/edit', [HolidayController::class, 'edit'])->name('holidays.edit');
        // attendances (absensi)
        Route::resource('/attendances', AttendanceController::class)->only(['index', 'create']);
        Route::get('/attendances/edit', [AttendanceController::class, 'edit'])->name('attendances.edit');

        // presences (kehadiran)
        Route::resource('/presences', PresenceController::class)->only(['index']);
        Route::get('/presences/qrcode', [PresenceController::class, 'showQrcode'])->name('presences.qrcode');
        Route::get('/presences/qrcode/download-pdf', [PresenceController::class, 'downloadQrCodePDF'])->name('presences.qrcode.download-pdf');
        Route::get('/presences/{attendance}', [PresenceController::class, 'show'])->name('presences.show');
        // not present data
        Route::get('/presences/{attendance}/not-present', [PresenceController::class, 'notPresent'])->name('presences.not-present');
        Route::post('/presences/{attendance}/not-present', [PresenceController::class, 'notPresent']);
        // present (url untuk menambahkan/mengubah user yang tidak hadir menjadi hadir)
        Route::post('/presences/{attendance}/present', [PresenceController::class, 'presentUser'])->name('presences.present');
        Route::post('/presences/{attendance}/acceptPermission', [PresenceController::class, 'acceptPermission'])->name('presences.acceptPermission');
        // employees permissions

        Route::get('/presences/{attendance}/permissions', [PresenceController::class, 'permissions'])->name('presences.permissions');

        Route::get('/information', [InformationController::class, 'index'])->middleware('auth')->name('information');
        Route::get('/information/index', [InformationController::class, 'index'])->middleware('auth')->name('information.index');
        Route::get('/information/create', [InformationController::class, 'create'])->name('information/create');
        Route::post('/information/store', [InformationController::class, 'store'])->name('information/store');
        Route::put('/information/update', [InformationController::class, 'update'])->name('information/update');
        Route::delete('/information/{id}', [InformationController::class, 'destroy'])->name('information/destroy');
        Route::get('/information/edit/{id}', [InformationController::class, 'edit'])->name('information/edit');

        Route::get('/assignment', [AssignmentController::class, 'index'])->middleware('auth')->name('assignment');
        Route::get('/assignment/index', [AssignmentController::class, 'index'])->middleware('auth')->name('assignment.index');
        Route::get('/assignment/create', [AssignmentController::class, 'create'])->name('assignment/create');
        Route::post('/assignment/store', [AssignmentController::class, 'store'])->name('assignment/store');
        Route::put('/assignment/update', [AssignmentController::class, 'update'])->name('assignment/update');
        Route::delete('/assignment/{id}', [AssignmentController::class, 'destroy'])->name('assignment/destroy');
        Route::get('/assignment/edit/{id}', [AssignmentController::class, 'edit'])->name('assignment/edit');
        Route::delete('/assignment/edit/{id}', [AssignmentController::class, 'destroyer'])->name('assignment/destroyer');

        Route::get('/task', [TaskController::class, 'index'])->middleware('auth')->name('task');
        Route::get('/task/index', [TaskController::class, 'index'])->middleware('auth')->name('task.index');
        Route::post('/task/store', [TaskController::class, 'store'])->name('task/store');

    });

    Route::middleware('role:user')->name("home.")->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::get('/home', [HomeController::class, 'index'])->name('home.index');
        Route::get('/dashboard-user', [DashboardUserController::class, 'index'])->name('dashboard-user.index');

        // desctination after scan qrcode
        Route::post('/absensi/qrcode', [HomeController::class, 'sendEnterPresenceUsingQRCode'])->name('sendEnterPresenceUsingQRCode');
        Route::post('/absensi/qrcode/out', [HomeController::class, 'sendOutPresenceUsingQRCode'])->name('sendOutPresenceUsingQRCode');

        Route::get('/absensi/{attendance}', [HomeController::class, 'show'])->name('show');
        Route::get('/absensi/{attendance}/permission', [HomeController::class, 'permission'])->name('permission');

        Route::get('/assignment-user', [AssignmentUserController::class, 'index'])->middleware('auth')->name('assignment-user');
        Route::get('/assignment-user/index', [AssignmentUserController::class, 'index'])->middleware('auth')->name('assignment-user.index');
        Route::get('/assignment-user/create', [AssignmentUserController::class, 'create'])->name('assignment-user/create');
        Route::post('/assignment-user/store', [AssignmentUserController::class, 'store'])->name('assignment-user/store');
        Route::post('/assignment-user/taskStore', [AssignmentUserController::class, 'taskStore'])->name('assignment-user/taskStore');
        Route::put('/assignment-user/update', [AssignmentUserController::class, 'update'])->name('assignment-user/update');
        Route::delete('/assignment-user/{id}', [AssignmentUserController::class, 'destroy'])->name('assignment-user/destroy');
        Route::get('/assignment-user/edit/{id}', [AssignmentUserController::class, 'edit'])->name('assignment-user/edit');
        Route::get('/assignment-user/edit/{id}', [AssignmentUserController::class, 'taskIndex'])->name('assignment-user/edit');
        Route::delete('/assignment-user/edit/{id}', [AssignmentUserController::class, 'destroyer'])->name('assignment-user/destroyer');
        Route::get('assignment/{id}', [AssignmentController::class, 'show'])->name('assignment.show');
        Route::get('/assignment-user/{id}', [AssignmentUserController::class, 'showTask'])->name('assignment-user.show');



        Route::get('/information-user', [InformationUserController::class, 'index'])->middleware('auth')->name('information-user');
        Route::get('/information-user/index', [InformationUserController::class, 'index'])->middleware('auth')->name('information-user.index');
        Route::get('/information-user/create', [InformationUserController::class, 'create'])->name('information-user/create');
        Route::post('/information-user/store', [InformationUserController::class, 'store'])->name('information-user/store');
        Route::put('/information-user/update', [InformationUserController::class, 'update'])->name('information-user/update');
        Route::delete('/information-user/{id}', [InformationUserController::class, 'destroy'])->name('information-user/destroy');
        Route::get('/information-user/edit/{id}', [InformationUserController::class, 'edit'])->name('information-user/edit');


    });

    //Location
    Route::get('/location', [LocationController::class, 'index'])->name('location.index');
    
    Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

    Route::middleware('guest')->group(function () {
    // auth
    Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'authenticate']);

    

});

