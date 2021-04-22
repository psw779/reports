<?php

use Illuminate\Support\Facades\Route;
use psw779\reports\Http\Controllers\ReportController;

Route::get(config('reports.uri') . '/sitemap.xml', [ReportController::class, 'sitemap']);
Route::get(config('reports.uri') . '/{category:slug?}', [ReportController::class, 'index'])->name('report.index');
Route::get(config('reports.uri') . '/{category:slug}/{report:slug}', [ReportController::class, 'show'])->name('report.show');
