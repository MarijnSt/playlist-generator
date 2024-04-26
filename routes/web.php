<?php

use App\Actions\Dashboard\RenderDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', RenderDashboard::class)->name('dashboard');
