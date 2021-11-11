<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('tag', 'TagCrudController');
    Route::crud('province', 'ProvinceCrudController');
    Route::crud('district', 'DistrictCrudController');
    Route::crud('locallevel', 'LocallevelCrudController');
    Route::crud('employee', 'EmployeeCrudController');
}); // this should be the absolute last line of this file
Route::group([
    'namespace'  => 'App\Http\Controllers\Api',
], function () { // custom admin routes

    Route::get('/api/getDistrict/{id}', 'DistrictCrudController@index');
    Route::get('/api/getLocallevel/{id}', 'LocallevelCrudController@index');
}); // this should be the absolute last line of this file