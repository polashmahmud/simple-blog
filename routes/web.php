<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\subscriptionController;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog/{post}', [HomeController::class, 'show'])->name('home.show');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('/posts', PostController::class);


Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
Route::get('/plans/{plan}', [PlanController::class, 'show'])->name('plans.show');
Route::get('/subscription', [SubscriptionController::class, 'success'])->name('subscription.success');
Route::post('/subscription', [SubscriptionController::class, 'create'])->name('subscription.create');
Route::get('/create/plan', [SubscriptionController::class, 'createPlan'])->name('create.plan');
Route::post('/store/plan', [SubscriptionController::class, 'storePlan'])->name('store.plan');



Route::get('settings', [SettingsController::class, 'index'])->name('settings');

