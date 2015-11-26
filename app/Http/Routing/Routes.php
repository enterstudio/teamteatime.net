<?php

// Auth
$router->controllers([
	'auth' 		=> 'Auth\AuthController',
	'password' 	=> 'Auth\PasswordController',
]);

// Admin
$router->group(['prefix' => 'admin', 'namespace' => 'Admin'], function ($router) {
	$router->resource('post', 'PostController');
	$router->resource('project', 'ProjectController');
	$router->resource('page', 'PageController');
});

// Blog
$router->group(['prefix' => 'blog'], function ($router) {
	$router->get('/', ['as' => 'blog.post.index', 'uses' => 'PostController@index']);
	$router->get('tag/{tag}', ['as' => 'blog.post.tag.index', 'uses' => 'PostController@index']);
	$router->get('archive/{year}/{month?}', ['as' => 'blog.post.archive.index', 'uses' => 'PostController@archive']);
	$router->get('{year}/{id}-{slug}', ['as' => 'blog.post.show', 'uses' => 'PostController@show']);
});

// Projects
$router->group(['prefix' => 'projects'], function ($router) {
	$router->get('/', ['as' => 'project.index', 'uses' => 'ProjectController@index']);
});

// Documentation
$router->group(['prefix' => 'docs'], function ($router) {
	$router->get('/', ['as' => 'docs.index', 'uses' => 'DocsController@index']);
	$router->get('{slug}/{paths?}', ['as' => 'docs.show', 'uses' => 'DocsController@show'])->where('paths', '(.*)');
});

// Pages
$router->get('/', ['as' => 'page.home', 'uses' => 'PageController@home']);
$router->get('{slug}', ['as' => 'page.show', 'uses' => 'PageController@show'])->where('slug', '(.*)');

// Model binding
$router->model('project', TTT\Models\Project::class);
$router->model('post', TTT\Models\Post::class);
$router->model('page', TTT\Models\Page::class);
