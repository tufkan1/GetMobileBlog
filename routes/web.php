<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::group(["middleware" => "notuser"],function (){
    Route::get("/", function (){
        return redirect()->route("login.index");
    });

    Route::get("/login", [UserController::class, "index"])->name("login.index");
    Route::post("/login", [UserController::class, "login"])->name("login.form");
});

Route::group(["middleware" => "user"],function (){
    Route::get("/", function (){
        return redirect()->route("app.index");
    });

    Route::get("/logout", [UserController::class, "logout"])->name("user.logout");

    Route::group(["prefix" => "app"],function (){
        Route::get("/", [AppController::class, "index"])->name("app.index");
        Route::get("/create", [AppController::class, "create"])->name("app.create");
        Route::post("/create", [AppController::class, "createForm"])->name("app.create.form");

        Route::get("/edit/{id}", [AppController::class, "edit"])->name("app.edit");
        Route::post("/edit/{id}", [AppController::class, "editForm"])->name("app.edit.form");

        Route::get("/delete/{id}", [AppController::class, "delete"])->name("app.delete");

        Route::get("/accept-list", [AppController::class, "accept"])->name("app.accept");
        Route::get("/accept/{id}", [AppController::class, "acceptForm"])->name("app.accept.form");

    });
});
