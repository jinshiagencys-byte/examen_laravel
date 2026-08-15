<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Models\Loan;
use App\Http\Controllers\SignageController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DistributionGroupController;
use App\Http\Controllers\EquipmentIssueController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/signage', function (Request $request) {
    return Loan::with('setup')
        ->where(function($query){
            $query->whereDate('start_date_time', '=', Carbon::today())
                  ->whereIn('status_id', [0, 1, 2, 3]);
        })->orWhere(function($query){
            $query->whereDate('end_date_time', '=', Carbon::today())
                  ->whereIn('status_id', [0, 1, 2, 3]);
        })->orWhere(function($query){
            $query->orWhereDate('start_date_time', '<', Carbon::today())
                   ->where('status_id', '=', 2);
        })->orderBy('start_date_time', 'asc')->get();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/assets', [AssetController::class, 'getAll']);
    Route::get('/users', [UserController::class, 'getAll']);
    Route::get('/distributionGroups', [DistributionGroupController::class, 'getAll']);
    Route::get('/equipmentIssues', [EquipmentIssueController::class, 'getAll']);
    Route::post('/loans', [LoanController::class, 'create']);
    Route::put('/loans/{id}', [LoanController::class, 'put']);
    Route::get('/locations', [LocationController::class, 'getAll']);
    Route::post('/setups', [SetupController::class, 'create']);
    Route::put('/setups/{id}', [SetupController::class, 'put']);
    Route::post('/incidents', [IncidentController::class, 'create']);
    Route::put('/incidents/{id}', [IncidentController::class, 'put']);

    // New exam API
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    Route::get('/materiels', [MaterielController::class, 'index']);
    Route::post('/materiels', [MaterielController::class, 'store']);
    Route::get('/materiels/{materiel}', [MaterielController::class, 'show']);
    Route::put('/materiels/{materiel}', [MaterielController::class, 'update']);
    Route::delete('/materiels/{materiel}', [MaterielController::class, 'destroy']);

    Route::get('/emprunts', [EmpruntController::class, 'index']);
    Route::post('/emprunts', [EmpruntController::class, 'store']);
    Route::get('/emprunts/{emprunt}', [EmpruntController::class, 'show']);
    Route::post('/emprunts/{emprunt}/return', [EmpruntController::class, 'return']);

    Route::get('/dashboard', [DashboardController::class, 'index']);
});
