<?php

use App\Livewire\Site\Game;
use App\Livewire\Site\Games;
use App\Livewire\Site\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/games', Games::class)->name('games');
Route::get('/game/{slug}', Game::class)->name('game');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
