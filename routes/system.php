<?php

//use App\Http\Controllers\BankAccountController; //revisar esta ruta da problemas
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Route::post('bank/account/store', [BankAccountController::class, 'storeOrUpdate']) //revisar esta ruta da problemas
    //     ->name('bank-account-store');
    // Route::delete('bank/account/destroy/{id}', [BankAccountController::class, 'destroy']) //revisar esta ruta da problemas
    //     ->name('bank-account-destroy');

    ///users///
    Route::get('datatables/users', [UserController::class, 'getUsers'])->name('users-tables-list');
});
