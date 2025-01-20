<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InstructorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourseController::class, 'index'])->name('index');

Route::resource('courses', CourseController::class)->except(['create', 'edit', 'show']);



Route::resource('categories', CategoryController::class)->except(['create', 'edit', 'show']);





Route::resource('instructors', InstructorController::class)->except(['create', 'edit', 'show']);