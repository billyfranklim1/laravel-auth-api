<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CORE\{
    User\UserController,
    System\SystemsController,
    Role\RolesController,
    Role\PermissionsController,
    UnitType\UnitTypeController,
    UnitGroup\UnitGroupController,
    Unit\UnitsController
};
use App\Http\Controllers\Webclin\{
    Antibiotic\AntibioticController,
    Anesthetist\AnesthetistsController,
    BloodType\BloodTypeController,
    Classification\ClassificationController,
    Specialty\SpecialtyController,
    BloodComponent\BloodComponentController,
    Postoperative\PostoperativeController,
    Size\SizeController,
    Patient\PatientController,
    MedicalRecord\MedicalRecordController,
    RTP\MonthlyConsolidatedController
};

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

Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        'user' => UserController::class,
        'system' => SystemsController::class,
        'role' => RolesController::class,
        'permission' => PermissionsController::class,
        'unit-type' => UnitTypeController::class,
        'unit' => UnitsController::class
    ]);
    Route::get('/unit-group', [UnitGroupController::class, 'index']);
    Route::get('/unit-group/{id}', [UnitGroupController::class, 'show']);

    Route::apiResources([
        'user' => UserController::class,
        'system' => SystemsController::class,
        'antibiotic' => AntibioticController::class,
        'blood-type' => BloodTypeController::class,
        'classification' => ClassificationController::class,
        'anesthetist' => AnesthetistsController::class,
        'specialty' => SpecialtyController::class,
        'blood-component' => BloodComponentController::class,
        'postoperative' => PostoperativeController::class,
        'size' => SizeController::class,
        'patient' => PatientController::class,
        'medical-record' => MedicalRecordController::class,
    ]);
    Route::get('/rtp', [MonthlyConsolidatedController::class, 'listMonths']);
});
