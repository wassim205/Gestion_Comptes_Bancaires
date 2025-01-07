<?php
session_start();



require_once ('../core/BaseController.php');
require_once '../core/Router.php';
require_once '../core/Route.php';
// require_once '../app/controllers/HomeController.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/AdminController.php';
require_once '../app/controllers/ClientController.php';
// require_once '../app/config/db.php';



$router = new Router();
Route::setRouter($router);



// client Routes
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'handleLogin']);
Route::get('/Client' , [ClientController::class, 'index']);
Route::get('/clients', [AdminController::class, 'getAllUsers']);






























// Admin Routes





// Dispatch the request
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);



