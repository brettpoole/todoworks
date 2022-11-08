<?php

use App\Http\Requests\StoreTodoRequest;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Repositories\TodoRepository;
use Illuminate\Support\Facades\Redirect;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/todos', function () {
    return Inertia::render('Todos/Index', [
        'todos' => auth()->user()->todos,
    ]);
})->middleware(['auth', 'verified'])->name('todos');

Route::post('/todos', function (StoreTodoRequest $request) {
    TodoRepository::createFromRequest($request, auth()->user());
    return Redirect::route('todos');
})->middleware(['auth', 'verified'])->name('todos.store');

require __DIR__.'/auth.php';
