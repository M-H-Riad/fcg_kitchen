<?php


Route::prefix('user')->group(function () {
    Route::get('/', 'Modules\User\Entities\UserController@index');

    Route::group(['middleware' => ['auth']], function () {
        Route::group(['middleware' => ['role:super-admin|data-entry', 'permission:role-list|role-create|role-edit|role-delete']], function () {
            Route::resource('roles', RoleController::class);
        });

        Route::resource('permissions', PermissionController::class);
        Route::resource('users', UserController::class);
        Route::get('user-profile', 'UserController@profile')->name('user.profile');
    });
});
