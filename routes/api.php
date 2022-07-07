<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function() {
    Route::get('/test', 'App\Http\Controllers\ComputerController@test');
    // chart 1
    Route::get('/top-ten-computer-models', 'App\Http\Controllers\ComputerController@getTopTenComputerModels');
    // chart 2
    Route::get('/operating-system-counts', 'App\Http\Controllers\ComputerController@getOperatingSystemCounts');
    // bar 1
    Route::get('/location-counts', 'App\Http\Controllers\ComputerController@getLocationCounts');
    // table
    Route::get('/table', 'App\Http\Controllers\ComputerController@getDataTableFormattedHtml');
    Route::get('/datatable-ssp', 'App\Http\Controllers\ComputerController@getDatatableSSP');
    // reset database.
    Route::get('/reset-database','App\Http\Controllers\ComputerController@resetDatabase');


});
