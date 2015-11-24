<?php

// Auth
$router->controllers([
	'auth' 		=> 'Auth\AuthController',
	'password' 	=> 'Auth\PasswordController',
]);

// Homepage
$router->get('/', ['as' => 'index', 'uses' => 'PageController@index']);

// Blog
$router->model('post', TTT\Models\Post::class);
$router->resource('blog/post', 'PostController');
$router->get('blog/posts', ['as' => 'blog.list', 'uses' => 'PostController@_list']);
$router->get('blog', ['as' => 'blog.index', 'uses' => 'PostController@index']);
$router->get('blog/tag/{tag}', ['as' => 'blog.tag.index', 'uses' => 'PostController@index']);
$router->get('blog/archive/{year}/{month?}', ['as' => 'blog.archive.index', 'uses' => 'PostController@archive']);
$router->get('blog/{year}/{id}-{slug}', ['as' => 'blog.post.show', 'uses' => 'PostController@show']);

// Pages
$router->model('pages', TTT\Models\Page::class);
$router->resource('pages', 'PageController');
$router->get('pages', ['as' => 'pages.list', 'uses' => 'PageController@_list']);
$router->get('{slug}', ['as' => 'pages.show', 'uses' => 'PageController@show'])->where('slug', '(.*)');

// Projects
$router->model('projects', TTT\Models\Project::class);
$router->resource('projects', 'ProjectController');
$router->get('projects', ['as' => 'projects.list', 'uses' => 'ProjectController@_list']);
