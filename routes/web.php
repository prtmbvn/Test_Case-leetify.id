<?php

use App\Http\Controllers\{DepartmentController,EmployeeController,AttendanceController,AttendanceHistoryController};

Route::view('/', 'home')->name('home');

Route::resource('departments', DepartmentController::class);
Route::resource('employees',  EmployeeController::class);

// Resource read-only untuk entitas attendance dan history (opsional)
Route::resource('attendances', AttendanceController::class)->only(['index','show','destroy']);
Route::resource('attendance-histories', AttendanceHistoryController::class)->only(['index','show','destroy']);

Route::prefix('attendance')->name('attendance.')->group(function () {
    Route::get('check-in',  [AttendanceController::class, 'showCheckIn'])->name('checkin.form');
    Route::post('check-in', [AttendanceController::class, 'checkIn'])->name('checkin.store');

    Route::get('check-out',  [AttendanceController::class, 'showCheckOut'])->name('checkout.form');
    Route::post('check-out', [AttendanceController::class, 'checkOut'])->name('checkout.store');

    Route::get('logs', [AttendanceController::class, 'logs'])->name('logs'); // list + ketepatan + filter
});

Route::resource('employees', EmployeeController::class);
Route::resource('departments', DepartmentController::class);
Route::resource('attendance-histories', AttendanceHistoryController::class)
    ->only(['index','show','destroy']);