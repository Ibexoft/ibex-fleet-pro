<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\driver\DriverController;
use App\Http\Controllers\vehicle\VehicleController;
use App\Http\Controllers\maintenance\MaintenanceController;
use App\Http\Controllers\insurance\InsuranceController;
use App\Http\Controllers\workshop\WorkshopController;
use App\Http\Controllers\fine\FineController;
use App\Http\Controllers\booking\BookingController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\role\RoleController;
use App\Http\Controllers\tracking\TrackingController;
use App\Http\Controllers\incompany\InsurancecompanyController;
use App\Http\Controllers\contract\ContractController;
use App\Http\Controllers\ControllerSetting;
use App\Http\Controllers\ControllerWorkshopType;
use App\Http\Controllers\website\WebsiteController;
use Illuminate\Support\Facades\Auth;
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

// ---------------------------Home routes-----------------------------------------

Route::get('/home', [WebsiteController::class, 'home'])->name('home');

Route::get('/', function () {
    if (Auth::user() && Auth::user()->hasRole('Super-Admin')) {
        return redirect('dashboard');
    }

    if (Auth::user() && !Auth::user()->hasRole('Super-Admin')) {
        return redirect('home');
    }

    return redirect('login');
});

// ---------------------------Search vehicle routes-----------------------------------------

Route::get('/search', [VehicleController::class, 'search'])->name('vehicles.search');

// ---------------------------Login Register routes-----------------------------------------

Route::get('/loginRegister', [WebsiteController::class, 'loginRegister'])->name('loginRegister');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/forgotten-password', function () {
    return view('auth.forgottenPassword');
});
Route::get('/reset-password', function () {
    return view('auth.resetPassword');
});
Route::post('fetch-driver', [FineController::class, 'FetchDriver'])->name('fetch-driver');
Route::post('fetch-owner', [FineController::class, 'FetchOwner'])->name('fetch-owner');
Route::post('fetch-car-owner', [InsuranceController::class, 'FetchCarOwner'])->name('fetch-car-owner');
Route::post('fetch-vin-data', [ContractController::class, 'fetchVin'])->name('fetch-vin');
Route::post('fetch-insurance-data', [ContractController::class, 'fetchInsurance'])->name('fetch-insurance');
Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // ---------------------------owner crud routes-----------------------------------------

    Route::get('settings/owners', [CustomerController::class, 'index'])->name('owners');
    Route::get('settings/owner/create', [CustomerController::class, 'create'])->name('owner.create');
    Route::post('settings/owner/store', [CustomerController::class, 'store'])->name('owner.store');
    Route::get('settings/owner/edit/{id}', [CustomerController::class, 'edit'])->name('owner.edit');
    Route::post('settings/owner/update/{id}', [CustomerController::class, 'update'])->name('owner.update');
    Route::post('settings/owner/delete', [CustomerController::class, 'destroy'])->name('owner.delete');
    Route::post('settings/owner/status', [CustomerController::class, 'statusUpdate'])->name('owner.status');
    Route::get('settings/owner/{id}', [CustomerController::class, 'show'])->name('owner.show');
    Route::post('settings/get-owners', [CustomerController::class, 'getOwners'])->name('get-owners');
    Route::post('settings/get-companies', [CustomerController::class, 'getCompanies'])->name('get-companies');
    // get owners based on type, function name is getOwnersBasedOnType
    Route::post('settings/get-owners-based-on-type', [CustomerController::class, 'getOwnersBasedOnType'])->name('get-owners-based-on-type');

    // ---------------------------driver crud routes-----------------------------------------

    Route::get('drivers', [DriverController::class, 'index'])->name('drivers');
    Route::get('driver/create', [DriverController::class, 'create'])->name('driver.create');
    Route::post('driver/store', [DriverController::class, 'store'])->name('driver.store');
    Route::get('driver/edit/{id}', [DriverController::class, 'edit'])->name('driver.edit');
    Route::post('driver/update/{id}', [DriverController::class, 'update'])->name('driver.update');
    // Route::post('driver/delete', [DriverController::class, 'destroy'])->name('driver.delete');
    Route::post('driver/status', [DriverController::class, 'statusUpdate'])->name('driver.status');
    Route::get('driver/print-profile/{id}', [DriverController::class, 'printDriverProfile'])->name('driver.print');
    Route::get('driver/{id}', [DriverController::class, 'show'])->name('driver.show');

    // ---------------------------Vehicle crud routes-----------------------------------------

    Route::get('vehicles', [VehicleController::class, 'index'])->name('vehicles');
    Route::get('available-vehicles', [VehicleController::class, 'availableVehicles'])->name('available.vehicles');
    Route::get('vehicle/create', [VehicleController::class, 'create'])->name('vehicle.create');
    Route::post('vehicle/store', [VehicleController::class, 'store'])->name('vehicle.store');
    Route::get('vehicle/edit/{id}', [VehicleController::class, 'edit'])->name('vehicle.edit');
    Route::post('vehicle/update/{id}', [VehicleController::class, 'update'])->name('vehicle.update');
    Route::post('vehicle/delete', [VehicleController::class, 'destroy'])->name('vehicle.delete');
    Route::post('vehicle/status', [VehicleController::class, 'statusUpdate'])->name('vehicle.status');
    Route::get('vehicle/{id}', [VehicleController::class, 'show'])->name('vehicle.show');
    Route::post('get-vehicle-owner', [VehicleController::class, 'getVehicleOwner'])->name('get-vehicle-owner');
    Route::post('/vehicle/{id}/toggle-sell-status', [VehicleController::class, 'toggleSellStatus'])->name('vehicle.toggleSellStatus');



    // ---------------------------maintenance crud routes-----------------------------------------

    Route::get('maintenance', [MaintenanceController::class, 'index'])->name('maintenance');
    Route::get('maintenance/create/{id?}', [MaintenanceController::class, 'create'])->name('maintenance.create');
    Route::post('maintenance/store', [MaintenanceController::class, 'store'])->name('maintenance.store');
    Route::get('maintenance/edit/{id}', [MaintenanceController::class, 'edit'])->name('maintenance.edit');
    Route::post('maintenance/update/{id}', [MaintenanceController::class, 'update'])->name('maintenance.update');
    Route::post('maintenance/delete', [MaintenanceController::class, 'destroy'])->name('maintenance.delete');
    Route::post('maintenance/status', [MaintenanceController::class, 'statusUpdate'])->name('maintenance.status');
    Route::post('return-actual-date', [MaintenanceController::class, 'returnActualDate'])->name('maintenance.returnactualdate');
    Route::get('return-maintenance-date/{id}', [MaintenanceController::class, 'returndate'])->name('maintenance.returndate');
    Route::get('maintenance/{id}', [MaintenanceController::class, 'show'])->name('maintenance.show');
    Route::get('process-maintenance/{id}', [MaintenanceController::class, 'processMaintenance'])->name('maintenance.process');
    Route::post('maintenance-complete/{id}', [MaintenanceController::class, 'complete'])->name('maintenance.complete');
    Route::get('edit-processed-maintenance/{id}', [MaintenanceController::class, 'editProcessedMaintenance'])->name('maintenance.edit-processed');
    Route::post('update-processed-maintenance/{id}', [MaintenanceController::class, 'updateProcessedMaintenance'])->name('maintenance.update-processed');


    // ---------------------------insurance crud routes-----------------------------------------

    // Route::get('insurances', [InsuranceController::class, 'index'])->name('insurances');
    Route::get('insurance/create/{id?}', [InsuranceController::class, 'create'])->name('insurance.create');
    Route::post('insurance/store', [InsuranceController::class, 'store'])->name('insurance.store');
    Route::get('insurance/edit/{id}', [InsuranceController::class, 'edit'])->name('insurance.edit');
    Route::post('insurance/update/{id}', [InsuranceController::class, 'update'])->name('insurance.update');
    Route::post('insurance/delete', [InsuranceController::class, 'destroy'])->name('insurance.delete');
    Route::post('insurance/status', [InsuranceController::class, 'statusUpdate'])->name('insurance.status');
    Route::get('insurance/{id}', [InsuranceController::class, 'show'])->name('insurance.show');

    // ---------------------------workshop crud routes-----------------------------------------

    Route::get('settings/workshops', [WorkshopController::class, 'index'])->name('workshops');
    Route::get('settings/workshop/create', [WorkshopController::class, 'create'])->name('workshop.create');
    Route::post('settings/workshop/store', [WorkshopController::class, 'store'])->name('workshop.store');
    Route::get('settings/workshop/edit/{id}', [WorkshopController::class, 'edit'])->name('workshop.edit');
    Route::post('settings/workshop/update/{id}', [WorkshopController::class, 'update'])->name('workshop.update');
    Route::post('settings/workshop/delete', [WorkshopController::class, 'destroy'])->name('workshop.delete');
    Route::post('settings/workshop/status', [WorkshopController::class, 'statusUpdate'])->name('workshop.status');
    Route::get('settings/workshop/{id}', [WorkshopController::class, 'show'])->name('workshop.show');
    Route::post('settings/get-workshops', [WorkshopController::class, 'getWorkshops'])->name('get-workshops');

    // ---------------------------Fine crud routes-----------------------------------------

    Route::get('fines', [FineController::class, 'index'])->name('fines');
    Route::get('fine/create', [FineController::class, 'create'])->name('fine.create');
    Route::post('fine/store', [FineController::class, 'store'])->name('fine.store');
    Route::get('fine/edit/{id}', [FineController::class, 'edit'])->name('fine.edit');
    Route::post('fine/update/{id}', [FineController::class, 'update'])->name('fine.update');
    Route::post('fine/delete', [FineController::class, 'destroy'])->name('fine.delete');
    Route::post('fine/status', [FineController::class, 'statusUpdate'])->name('fine.status');
    Route::get('fine/{id}', [FineController::class, 'show'])->name('fine.show');
    Route::post('fine/{id}/comments', [FineController::class, 'storeComment'])->name('fine.comment.store');

    // ---------------------------Boooking crud routes-----------------------------------------

    Route::get('bookings', [BookingController::class, 'index'])->name('bookings');
    Route::get('booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::get('booking/create/{id}/{startdate}/{enddate}', [BookingController::class, 'create'])->name('booking.create.withdates');
    Route::post('booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('booking/edit/{id}', [BookingController::class, 'edit'])->name('booking.edit');
    Route::post('booking/update/{id}', [BookingController::class, 'update'])->name('booking.update');
    Route::post('booking/delete', [BookingController::class, 'destroy'])->name('booking.delete');
    Route::post('booking/status', [BookingController::class, 'statusUpdate'])->name('booking.status');
    Route::get('booking/{id}', [BookingController::class, 'show'])->name('booking.show');
    Route::post('return-booking-date/{id}', [BookingController::class, 'returndate'])->name('booking.returndate');
    Route::post('booking-graph', [BookingController::class, 'graphData'])->name('booking.graph');
    Route::post('booking-availability', [BookingController::class, 'availability'])->name('booking.availability');
    Route::post('booking/{id}/comments', [bookingController::class, 'storeComment'])->name('booking.comment.store');
    Route::get('/reservations', [BookingController::class, 'reservations'])->name('reservations');
    Route::post('booking/{id}/extend', [BookingController::class, 'extendEndDate'])->name('booking.extend');


    // ---------------------------Comment ud routes-----------------------------------------
    Route::post('comment/update/{commentId}', [CommentController::class, 'editComment'])->name('comment.edit');
    Route::delete('comment/delete/{commentId}', [CommentController::class, 'deleteComment'])->name('comment.delete');

    // ---------------------------user crud routes-----------------------------------------

    Route::get('settings/users', [UserController::class, 'index'])->name('users');
    Route::get('settings/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('settings/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('settings/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('settings/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('settings/user/delete', [UserController::class, 'destroy'])->name('user.delete');
    Route::post('settings/user/status', [UserController::class, 'statusUpdate'])->name('user.status');
    Route::get('settings/user/{id}', [UserController::class, 'show'])->name('user.show');

    // ---------------------------role crud routes-----------------------------------------

    Route::get('settings/roles', [RoleController::class, 'index'])->name('roles');
    Route::get('settings/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('settings/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('settings/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('settings/role/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::post('settings/role/delete', [RoleController::class, 'destroy'])->name('role.delete');
    Route::post('settings/role/status', [RoleController::class, 'statusUpdate'])->name('role.status');

    // ---------------------------Tracking routes-----------------------------------------

    // Route::get('trackings', [TrackingController::class, 'index'])->name('trackings');
    Route::get('tracking/create/{id?}', [TrackingController::class, 'create'])->name('tracking.create');
    Route::post('tracking/store', [TrackingController::class, 'store'])->name('tracking.store');
    Route::get('tracking/edit/{id}', [TrackingController::class, 'edit'])->name('tracking.edit');
    Route::post('tracking/update/{id}', [TrackingController::class, 'update'])->name('tracking.update');
    Route::post('tracking/delete', [TrackingController::class, 'destroy'])->name('tracking.delete');
    Route::post('tracking/status', [TrackingController::class, 'statusUpdate'])->name('tracking.status');
    Route::get('tracking/{id}', [TrackingController::class, 'show'])->name('tracking.show');

    // ---------------------------Insurance  company routes-----------------------------------------

    Route::get('settings/insurance-companies', [InsurancecompanyController::class, 'index'])->name('insurance-companies');
    Route::get('settings/insurance-company/create', [InsurancecompanyController::class, 'create'])->name('insurance-company.create');
    Route::post('settings/insurance-company/store', [InsurancecompanyController::class, 'store'])->name('insurance-company.store');
    Route::get('settings/insurance-company/edit/{id}', [InsurancecompanyController::class, 'edit'])->name('insurance-company.edit');
    Route::post('settings/insurance-company/update/{id}', [InsurancecompanyController::class, 'update'])->name('insurance-company.update');
    Route::post('settings/insurance-company/delete', [InsurancecompanyController::class, 'destroy'])->name('insurance-company.delete');
    Route::post('settings/insurance-company/status', [InsurancecompanyController::class, 'statusUpdate'])->name('insurance-company.status');
    Route::get('settings/insurance-company/{id}', [InsurancecompanyController::class, 'show'])->name('insurance-company.show');


    //--------------------------Maintenance Type routes-------------------------------------

    Route::get('settings/maintenance-types', [ControllerSetting::class, 'index'])->name('maintenance-types');
    Route::get('settings/maintenance-type/create', [ControllerSetting::class, 'create'])->name('maintenance-type.create');
    Route::post('settings/maintenance-type/store', [ControllerSetting::class, 'store'])->name('maintenance-type.store');
    Route::get('settings/maintenance-type/edit/{id}', [ControllerSetting::class, 'edit'])->name('maintenance-type.edit');
    Route::post('settings/maintenance-type/update/{id}', [ControllerSetting::class, 'update'])->name('maintenance-type.update');
    Route::post('settings/maintenance-type/delete', [ControllerSetting::class, 'destroy'])->name('maintenance-type.delete');
    Route::post('settings/maintenance-type/status', [ControllerSetting::class, 'statusUpdate'])->name('maintenance-type.status');
    Route::post('settings/get-maintenance-types', [ControllerSetting::class, 'getMaintenanceTypes'])->name('get-maintenance-types');
    // Route::get('settings/maintenance-type/{id}', [ControllerSetting::class, 'show'])->name('maintenance-type.show');

    //--------------------------Workshop Type routes-------------------------------------

    Route::get('settings/workshop-types', [ControllerWorkshopType::class, 'index'])->name('workshop-types');
    Route::get('settings/workshop-type/create', [ControllerWorkshopType::class, 'create'])->name('workshop-type.create');
    Route::post('settings/workshop-type/store', [ControllerWorkshopType::class, 'store'])->name('workshop-type.store');
    Route::get('settings/workshop-type/edit/{id}', [ControllerWorkshopType::class, 'edit'])->name('workshop-type.edit');
    Route::post('settings/workshop-type/update/{id}', [ControllerWorkshopType::class, 'update'])->name('workshop-type.update');
    Route::post('settings/workshop-type/delete', [ControllerWorkshopType::class, 'destroy'])->name('workshop-type.delete');
    Route::post('settings/workshop-type/status', [ControllerWorkshopType::class, 'statusUpdate'])->name('workshop-type.status');
    // Route::get('settings/workshop-type/{id}', [ControllerWorkshopType::class, 'show'])->name('workshop-type.show');

    //--------------------------Profile route-------------------------------------

    Route::get('settings/profile', [UserController::class, 'editProfile'])->name('profile');
    Route::post('settings/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

    //-------------------------Setting Route---------------------------------

    Route::get('settings', [ControllerSetting::class, 'setting'])->name('settings');
});

Route::get('/bookingForm', [WebsiteController::class, 'bookingForm'])->name('bookingForm');
Route::get('/confirmBooking/{booking_id}', [WebsiteController::class, 'confirmBooking'])->name('confirmBooking');
Route::get('/forgotPassword', [WebsiteController::class, 'forgotPassword'])->name('forgotPassword');
