<?php

use App\Http\Controllers\NotesController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Models\Note;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->name('profile');

    Route::view('/notes', 'notes.index')
        ->name('notes.index');

    Route::view('notes/create', 'notes.create')
        ->name('notes.create');

    Volt::route('notes/{note}/edit', 'notes/edit-note')
        ->name('note.edit');
});

Route::get('notes/{note}', function (Note $note) {
    if (!$note->is_published) {
        abort(404);
    }
    $user = $note->user;
    return view('notes.view', ['note' => $note, 'user' => $user]);
})->name('notes.view');

require __DIR__ . '/auth.php';
