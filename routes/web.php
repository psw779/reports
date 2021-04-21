<?php

use Illuminate\Support\Facades\Route;
use psw779\reports\Http\Controllers\ReportsController;

Route::get(config('report.uri') . '/sitemap.xml', [ReportController::class, 'sitemap']);
Route::get(config('report.uri') . '/{category:slug?}', [ReportController::class, 'index'])->name('report.index');
Route::get(config('report.uri') . '/{category:slug}/{report:slug}', [ReportController::class, 'show'])->name('report.show');
