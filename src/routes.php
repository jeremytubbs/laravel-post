<?php

// Main default listing e.g. http://domain.com/blog
Route::get(Config::get('laravel-post::routes.base_uri'), 'JeremyTubbs\LaravelPost\PostsController@index');

if (Config::get('laravel-post::routes.relationship_uri_prefix'))
{
	// Relationship filtered listing, e.g. by category or tag, e.g. http://domain.com/blog/category/my-category
	Route::get(Config::get('laravel-post::routes.base_uri').'/'.Config::get('laravel-post::routes.relationship_uri_prefix').'/{relationshipIdentifier}', 'JeremyTubbs\LaravelPost\PostsController@indexByRelationship');
}

// Blog post detail page e.g. http://domain.com/blog/my-post
Route::get(Config::get('laravel-post::routes.base_uri').'/{slug}', 'JeremyTubbs\LaravelPost\PostsController@show');

//Admin Area Routes e.g. http://domian/admin/posts/create
Route::group(array('before' => 'laravel-post::routes.before_filter', 'prefix' => 'laravel-post::routes.route_prefix'), function() {
    Route::resource('posts', 'JeremyTubbs\LaravelPost\PostsController', ['only' => ['create', 'update', 'destroy', 'store', 'edit']]);
});