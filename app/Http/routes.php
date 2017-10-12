<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'IndexController@indexAction');
Route::get('/galleries', 'GalleryController@galleriesAction');
Route::get('/gallery/{id}', 'GalleryController@galleryAction');
Route::get('/tags/{tag}', 'TagController@tagAction');
Route::get('/sitemap.xml', 'SitemapController@xmlAction');
