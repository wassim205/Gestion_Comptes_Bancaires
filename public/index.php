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





// Dispatch the request
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);



