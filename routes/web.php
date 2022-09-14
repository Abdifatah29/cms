<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Basic routes
Route::get('/', function () {  
    return view('welcome');
});

/**
 * Match Routes
*/
$routes_methods = ['post', 'get', 'delete', 'put', 'option', 'patch'];
Route::match($routes_methods, '/id/{id}', function($id)
{
    return $id;
});

/** 
 * Dependency Injection Routes
*/
Route::get('/request', function(Request $request)
{
    var_dump($request);
});


/**
 * Redirect Routes
*/

Route::redirect('/admins', '/admin');

/**
 * View Routes
 */

 Route::view('/user', 'user', ['userId' => 12]);


 /**
  * Required Parameters
  */

Route::get('/required/{id}', function($id)
{
    return 'Id: ' . $id;
});


/**
 * Naming routes
 */

 Route::get('/admin/posts');


/**
 * 
 * using Controllers with Routes
 * 
 */

 Route::get('/test/{postId}', [PostController::class, 'index']);



 /**
  * 
  * Resource route
  *
  */

  Route::resource('/posts', PostController::class);