<?php

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
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\role\RoleController;
use App\Http\Controllers\tracking\TrackingController;
use App\Http\Controllers\incompany\InsurancecompanyController;
use App\Http\Controllers\contract\ContractController;
use App\Http\Controllers\ControllerSetting;

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

Route::get('/', function () {
    return view('auth.login');
});
Route::post('/fetch-car-owner',[InsuranceController::class,'FetchCarOwner']);
Route::post('/fetch-vin-data',[ContractController::class,'fetchVin']);
Route::post('/fetch-insurance-data',[ContractController::class,'fetchInsurance']);


Auth::routes();

Route::group(['middleware' => ['auth']], function() {

Route::get('/dashboard', [HomeController::class, 'index']);
Route::group(['middleware' => ['role']], function() {

// ---------------------------customer crud routes-----------------------------------------
Route::get('/list-customer',[CustomerController::class,'index']);
Route::get('/add-customer',[CustomerController::class,'create']);
Route::post('/save-customer',[CustomerController::class,'store']);
Route::get('/edit-customer/{id}',[CustomerController::class,'edit']);
Route::post('/update-customer/{id}',[CustomerController::class,'update']);
Route::post('/delete-customer',[CustomerController::class,'delete']);
Route::post('/update-customer-status',[CustomerController::class,'statusUpdate']);
// ---------------------------driver crud routes-----------------------------------------
Route::get('/list-driver',[DriverController::class,'index']);
Route::get('/add-driver',[DriverController::class,'create']);
Route::post('/save-driver',[DriverController::class,'store']);
Route::get('/edit-driver/{id}',[DriverController::class,'edit']);
Route::get('/view-driver/{id}',[DriverController::class,'show']);
Route::post('/update-driver/{id}',[DriverController::class,'update']);
Route::post('/delete-driver',[DriverController::class,'destroy']);
Route::post('/update-driver-status',[DriverController::class,'statusUpdate']);
Route::get('/print-driver-profile/{id}',[DriverController::class,'printDriverProfile']);

// ---------------------------Vehicle crud routes-----------------------------------------
Route::get('list-vehicle',[VehicleController::class,'index']);
Route::get('/add-vehicle',[VehicleController::class,'create']);
Route::post('/save-vehicle',[VehicleController::class,'store']);
Route::get('/edit-vehicle/{id}',[VehicleController::class,'edit']);
Route::post('/update-vehicle/{id}',[VehicleController::class,'update']);
Route::post('/delete-vehicle',[VehicleController::class,'destroy']);
Route::post('/update-vehicle-status',[VehicleController::class,'statusUpdate']);
// ---------------------------maintenance crud routes-----------------------------------------
Route::get('list-maintenance',[MaintenanceController::class,'index']);
Route::get('/add-maintenance',[MaintenanceController::class,'create']);
Route::post('/save-maintenance',[MaintenanceController::class,'store']);
Route::get('/edit-maintenance/{id}',[MaintenanceController::class,'edit']);
Route::post('/update-maintenance/{id}',[MaintenanceController::class,'update']);
Route::post('/delete-maintenance',[MaintenanceController::class,'destroy']);
Route::post('/update-maintenance-status',[MaintenanceController::class,'statusUpdate']);
Route::post('/return-actual-date',[MaintenanceController::class,'returnActualDate']);
Route::get('/return-maintenance-date/{id}',[MaintenanceController::class,'returndate']);
// ---------------------------insurance crud routes-----------------------------------------
Route::get('list-insurance',[InsuranceController::class,'index']);
Route::get('/add-insurance',[InsuranceController::class,'create']);
Route::post('/save-insurance',[InsuranceController::class,'store']);
Route::get('/edit-insurance/{id}',[InsuranceController::class,'edit']);
Route::post('/update-insurance/{id}',[InsuranceController::class,'update']);
Route::post('/delete-insurance',[InsuranceController::class,'destroy']);
Route::post('/update-insurance-status',[InsuranceController::class,'statusUpdate']);

// ---------------------------workshop crud routes-----------------------------------------
Route::get('list-workshop',[WorkshopController::class,'index']);
Route::get('/add-workshop',[WorkshopController::class,'create']);
Route::post('/save-workshop',[WorkshopController::class,'store']);
Route::get('/edit-workshop/{id}',[WorkshopController::class,'edit']);
Route::post('/update-workshop/{id}',[WorkshopController::class,'update']);
Route::post('/delete-workshop',[WorkshopController::class,'destroy']);
Route::post('/update-workshop-status',[WorkshopController::class,'statusUpdate']);
// ---------------------------Fine crud routes-----------------------------------------
Route::get('list-fine',[FineController::class,'index']);
Route::get('/add-fine',[FineController::class,'create']);
Route::post('/save-fine',[FineController::class,'store']);
Route::get('/edit-fine/{id}',[FineController::class,'edit']);
Route::post('/update-fine/{id}',[FineController::class,'update']);
Route::post('/delete-fine',[FineController::class,'destroy']);
Route::post('/update-fine-status',[FineController::class,'statusUpdate']);

// ---------------------------Boooking crud routes-----------------------------------------
Route::get('list-booking',[BookingController::class,'index']);
Route::get('/add-booking',[BookingController::class,'create']);
Route::post('/save-booking',[BookingController::class,'store']);
Route::get('/edit-booking/{id}',[BookingController::class,'edit']);
Route::post('/update-booking/{id}',[BookingController::class,'update']);
Route::post('/delete-booking',[BookingController::class,'destroy']);
Route::post('/update-booking-status',[BookingController::class,'statusUpdate']);
// ---------------------------user crud routes-----------------------------------------
Route::get('/list-user',[UserController::class,'index']);
Route::get('/add-user',[UserController::class,'create']);
Route::post('/save-user',[UserController::class,'store']);
Route::get('/edit-user/{id}',[UserController::class,'edit']);
Route::post('/update-user/{id}',[UserController::class,'update']);
Route::post('/delete-user',[UserController::class,'delete']);
Route::post('/update-user-status',[UserController::class,'statusUpdate']);
// ---------------------------role crud routes-----------------------------------------
Route::get('/list-role',[RoleController::class,'index']);
Route::get('/add-role',[RoleController::class,'create']);
Route::post('/save-role',[RoleController::class,'store']);
Route::get('/edit-role/{id}',[RoleController::class,'edit']);
Route::post('/update-role/{id}',[RoleController::class,'update']);
Route::post('/delete-role',[RoleController::class,'delete']);
Route::post('/update-role-status',[RoleController::class,'statusUpdate']);
// ---------------------------Tracking routes-----------------------------------------
Route::get('/list-tracking',[TrackingController::class,'index']);
Route::get('/add-tracking',[TrackingController::class,'create']);
Route::post('/save-tracking',[TrackingController::class,'store']);
Route::get('/edit-tracking/{id}',[TrackingController::class,'edit']);
Route::post('/update-tracking/{id}',[TrackingController::class,'update']);
Route::post('/delete-tracking',[TrackingController::class,'destroy']);
Route::post('/update-tracking-status',[TrackingController::class,'statusUpdate']);
// ---------------------------Insurance  company routes-----------------------------------------
Route::get('/list-incompany',[InsurancecompanyController::class,'index']);
Route::get('/add-incompany',[InsurancecompanyController::class,'create']);
Route::post('/save-incompany',[InsurancecompanyController::class,'store']);
Route::get('/edit-incompany/{id}',[InsurancecompanyController::class,'edit']);
Route::post('/update-incompany/{id}',[InsurancecompanyController::class,'update']);
Route::post('/delete-incompany',[InsurancecompanyController::class,'delete']);
Route::post('/update-incompany-status',[InsurancecompanyController::class,'statusUpdate']);
// ---------------------------Contract routes-----------------------------------------
Route::get('/list-contract',[ContractController::class,'index']);
Route::get('/add-contract',[ContractController::class,'create']);
Route::post('/save-contract',[ContractController::class,'store']);
Route::get('/edit-contract/{id}',[ContractController::class,'edit']);
Route::post('/update-contract/{id}',[ContractController::class,'update']);
Route::post('/delete-contract',[ContractController::class,'destroy']);
Route::post('/update-contract-status',[ContractController::class,'statusUpdate']);

//--------------------------setting route-------------------------------------
Route::get('/list-maintenance_type',[ControllerSetting::class,'index']);
Route::get('/add-maintenance_type',[ControllerSetting::class,'create']);
Route::post('/save-maintenance_type',[ControllerSetting::class,'store']);
Route::get('/edit-maintenance_type/{id}',[ControllerSetting::class,'edit']);
Route::post('/update-maintenance_type/{id}',[ControllerSetting::class,'update']);
Route::post('/delete-maintenance_type',[ControllerSetting::class,'destroy']);
Route::post('/update-maintenance_type-status',[ControllerSetting::class,'statusUpdate']);
});
});
