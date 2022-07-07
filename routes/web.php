<?php

use App\Models\Computer;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/charts', function () {
    return view('chart');
});

Route::get('/tables', function () {
    $computer = new Computer();
    $departments = $computer->getDepartments();
    $computerModels = $computer->getComputerModels();
    return view('table', ['departments'=>$departments, 'computerModels'=>$computerModels]);
});
