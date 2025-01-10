<?php
session_start();



require_once ('../core/BaseController.php');
require_once '../core/Router.php';
require_once '../core/Route.php';
// require_once '../app/controllers/HomeController.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/AdminController.php';
require_once '../app/controllers/ClientController.php';
require_once '../app/controllers/TransactionController.php';
// require_once '../app/config/db.php';



$router = new Router();
Route::setRouter($router);



// client Routes
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'handleLogin']);
Route::get('/Client' , [ClientController::class, 'index']);
Route::get('/Admin' , [AdminController::class, 'index']);
Route::get('/profeil' , [ClientController::class, 'profeil']);
Route::get('/mcompte' , [ClientController::class, 'mcompte']);
Route::post('/modifier_password' , [ClientController::class, 'modifier_password']);
Route::post('/modifier_info' , [ClientController::class, 'modifier_profil']);
Route::post('/AlimenterSolde' , [TransactionController::class, 'alimenterSolde']);





























// Admin Routes


Route::get('/clients', [AdminController::class, 'getAllUsers']);
// Route::post('/clients', [AdminController::class, 'getAllUsers']);
Route::get('/compte', [AdminController::class, 'compte']);
Route::get('/transactions', [AdminController::class, 'transactions']);
Route::get('/index', [AdminController::class, 'dashboard']);
Route::get('/admin/change-status/{userId}/{status}', [AdminController::class, 'changeStatus']);
Route::get('/admin/deleteUser/{userId}', [AdminController::class, 'DeleteUser']);
Route::post('/admin/addingAUser', [AdminController::class, 'AddNewUser']);
Route::get('/admin/editAccount/{id}', [AdminController::class, 'editUser']);
Route::post('/admin/editAccount/', [AdminController::class, 'editUserAccount']);



// Dispatch the request
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);



