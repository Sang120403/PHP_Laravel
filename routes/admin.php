<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoaiPhimController;
use App\Http\Controllers\PhimController;
use App\Http\Controllers\LichTrinhController;
use App\Http\Controllers\DichVuController;

Route::post('/savestatus', [LoaiPhimController::class, 'saveStatus'])->name('save-status');
Route::post('/savestatus', [PhimController::class, 'saveStatus'])->name('save-status');

Route::prefix('admin')->group(function () {

    Route::get('/', [AdminController::class, 'home']);
    //Revenue
    // Route::get('/search_movie', [AdminController::class, 'search_movie']);
    // Route::get('/search_theater', [AdminController::class, 'search_theater']);
    // // statistical
    // Route::get('/filter-by-date', [AdminController::class, 'filter_by_date']);
    // Route::get('/statistical-filter', [AdminController::class, 'statistical_filter']);
    // Route::get('/statistical-sortby', [AdminController::class, 'statistical_sortby']);

    // // scan ticket
    // Route::prefix('scanTicket')->group(function () {
    //     Route::post('/handle', [StaffController::class, 'handleScanTicket']);
    //     Route::get('/', [StaffController::class, 'scanTicket']);
    // });

    Route::prefix('loaiphim')->group(function () {
        Route::get('/', [LoaiPhimController::class, 'loaiPhim']);
        Route::post('/create', [LoaiPhimController::class, 'postCreate']);
        Route::post('/edit/{id}', [LoaiPhimController::class, 'postEdit']);
        Route::post('/delete/{id}', [LoaiPhimController::class, 'delete']);

        
    });

    Route::prefix('phim')->group(function () {
        Route::get('/', [PhimController::class, 'phim']);
        Route::get('/create', [PhimController::class, 'getCreate']);
        Route::post('/create', [PhimController::class, 'postCreate']);
        Route::get('/edit/{id}', [PhimController::class, 'getEdit']);
        Route::post('/edit/{id}', [PhimController::class, 'postEdit']);

        // Route::post('/delete/{id}', [LoaiPhimController::class, 'delete']);

        
    });
    Route::prefix('lichtrinh')->group(function () {
        Route::get('/', [LichTrinhController::class, 'lichtrinh']);
        // Route::get('/create', [PhimController::class, 'getCreate']);
        Route::post('/create', [LichTrinhController::class, 'create']);
        // Route::get('/edit/{id}', [PhimController::class, 'getEdit']);
        // Route::post('/edit/{id}', [PhimController::class, 'postEdit']);

        // Route::post('/delete/{id}', [LoaiPhimController::class, 'delete']);
        Route::get('/status', [LichTrinhController::class, 'status']);
        Route::get('/early_status',[LichTrinhController::class,'early_status']);
        Route::post('/deleteAll', [LichTrinhController::class,'deleteAll']);
        Route::post('/xoaItem/{id}', [LichTrinhController::class,'xoaItem']);

    });

    Route::prefix('buyCombo')->group(function () {
        Route::get('/', [DichVuController::class, 'buyCombo']);
    });
});


    