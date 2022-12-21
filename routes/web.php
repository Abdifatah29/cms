<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Posts;
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
Route::get('/', function ()
{
    return view('welcome');
});

/**
 * Match Routes
*/
$routes_methods = ['post', 'get', 'delete', 'put', 'option', 'patch'];
Route::match($routes_methods, '/id/{id}', function ($id)
{
    return $id;
});

/**
 * Dependency Injection Routes
*/
Route::get('/request', function (Request $request)
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

Route::get('/required/{id}', function ($id)
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


  //contact route return contact view

  Route::get('/contact', [PostController::class, 'contact']);

  Route::get('post/{id}', [PostController::class, 'show_post']);


    /**
     * RAW sql Insert
    */

    Route::get('/insert', function ()
    {
        DB::insert('insert into posts (title, body) values(?,?)', ['Shukri', 'Faras']);
    });

    /**
     * RAW sql Select
    */

    Route::get('select', function ()
    {
        $results = DB::select("SELECT * FROM posts WHERE id = ?", [1]);

        foreach ($results as $result) {
            return $result->title;
        }
    });

    /**
     * RAW sql update
    */

    Route::get('update', function ()
    {
        $update = DB::update("UPDATE posts SET title ='Shukri' WHERE id = ?", [2]);
        $update = DB::update("UPDATE posts SET body = 'Cabdullahi' WHERE id = ?", [2]);
        return $update;
    });

    /**
     * RAW sql delete
    */

    Route::get('delete/{id}', function ($id)
    {
        return DB::delete('DELETE FROM posts where id = ?', [$id]);
    });



    /**
     * ELOQUENT ORM - Object Relational Model
     */

     // get multiple
     Route::get('/read', function ()
    {
        $posts = Posts::all();

        foreach ($posts as $post) {
            var_dump($post);
            return $post->title;
        }

    });


//get single


Route::get('/findwhere', function()
{
    $post = Posts::where('id', 2)->orderBy('id', 'desc')->take(1)->get();
    return $post;
});

//retriving data
Route::get('/findmore', function(Type $var = null)
{
    $posts = Posts::where('id', '>', 1)->firstOrFail();
    return $posts;
});

// Inserting data

Route::get('basicInsert', function (){
    $post = new Posts();
    $post->title = 'Hooyo';
    $post->body = 'macaan';
    $post->save();
});

Route::get('basicUpdate', function (){
    $post = Posts::find('2');
    $post->body = 'Cabdulahi';
    $post->save();
});

// create with ORM

Route::get('create', function(){
    $post = Posts::create(['title'=>'James', 'body' => 'Bond']);
    return $post;
});

// Updating ORM

Route::get('basicUpdate', function(){
    $post = Posts::where('id', 2)->where('created_at', null)->update(['title'=>'Danie']);
    return $post;
});


// Deleting ORM

Route::get('basicDelete', function(){
    $post = Posts::find(4)->delete();
});

// Deleting multiple

Route::get('deleteMulti', function(){
    $post = Posts::destroy([2,5]);
});


// deleted at

Route::get('softDelete', function(){
   Posts::find(3)->delete();
});