<?php

use App\Livewire\Chat\CreateChat;
use App\Livewire\Chat\Main;
use Illuminate\Support\Facades\Route;

Route::get('/users', CreateChat::class)->name('users');
Route::get('/chat{key?}', Main::class)->name('chat');

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
