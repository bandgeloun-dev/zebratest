<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controllers\SearchController::class, 'submit'])->name('search');
Route::get('/json', [Controllers\SearchController::class, 'download'])->name('json_file');

Route::get('/new', [Controllers\TenderController::class, 'showTenderPage'])->name('add');
Route::get('/csv', [Controllers\TenderController::class, 'csvToTenders']);
Route::post('/new', [Controllers\TenderController::class, 'saveTender']);

Auth::routes();

Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');
