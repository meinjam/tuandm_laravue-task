<?php

Route::get( 'get_posts', 'PostsController@index' );
Route::post( 'create_post', 'PostsController@store' );
Route::get( 'get_post/{id}', 'PostsController@edit' );
Route::post( 'edit_post', 'PostsController@update' );
Route::post( 'delete_post', 'PostsController@destroy' );

Route::get( '/', function () {
    return view( 'welcome' );
} );

Route::group( ['middleware' => 'web'], function () {
    Route::get( env( 'LARAVUE_PATH' ), 'LaravueController@index' )->where( 'any', '.*' )->name( 'laravue' );
} );
