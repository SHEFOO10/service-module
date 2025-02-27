<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\Api\ServiceController;
use Modules\Service\Http\Controllers\ServiceModuleController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/
Route::ApiResource('service', ServiceController::class);
