<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiRoleController;
use App\Http\Controllers\ApiCategoryController;

//Categories
Route::middleware('auth:sanctum')->group(function () {
    Route::get("/categories-query", [ApiCategoryController::class, "categoriesQuery"]);
    Route::delete("/delete-category/{id}", [ApiCategoryController::class, "categoryRemove"]);
    Route::post("/update-category/{id}", [ApiCategoryController::class, "categoryUpdate"]);
    //Roles
    Route::get("/query-permissions-roles", [ApiRoleController::class, "rolesQuery"]);
});