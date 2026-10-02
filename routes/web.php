<?php

use App\Http\Controllers\PpdbController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PpdbController::class, 'home'])->name('home');
Route::get('/pendaftaran', [PpdbController::class, 'register'])->name('register');
Route::post('/pendaftaran', [PpdbController::class, 'store'])->name('register.store');
Route::get('/login', [PpdbController::class, 'login'])->name('login');
Route::post('/login', [PpdbController::class, 'authenticate'])->name('login.auth');
Route::post('/logout', [PpdbController::class, 'logout'])->name('logout');
Route::get('/cek-status', [PpdbController::class, 'status'])->name('status');
Route::post('/cek-status', [PpdbController::class, 'checkStatus'])->name('status.check');
Route::get('/admin', [PpdbController::class, 'admin'])->name('admin');
Route::post('/admin/konfirmasi/{applicant}', [PpdbController::class, 'confirm'])->name('admin.confirm');
Route::get('/admin/export', [PpdbController::class, 'export'])->name('admin.export');
