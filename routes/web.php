<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('notes', 'notes.index')
    ->middleware(['auth', 'verified'])
    ->name('notes.index');

Route::view('notes/create', 'notes.create')
    ->middleware(['auth', 'verified'])
    ->name('notes.create');

Volt::route('notes/{note}/edit', 'notes/edit-note')
    ->middleware(['auth'])
    ->name('note.edit');

require __DIR__.'/auth.php';
