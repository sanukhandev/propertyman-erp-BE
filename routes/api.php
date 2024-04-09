<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\PropertyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login',[AuthController::class,'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        'company-profile' => CompanyProfileController::class,
        'customers' => CustomerController::class,
        'properties' => PropertyController::class,
        'contracts' => ContractController::class,
        'leads' => LeadsController::class,
    ], ['only' => ['index', 'show', 'store', 'update']]);
    Route::get('pdf', [ContractController::class, 'generatePdf']);
});



