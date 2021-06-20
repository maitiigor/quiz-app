 <?php

 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Route;

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

 Route::get('/admin', function () {
     return view('admin');
 })->middleware('admin');
Auth::routes();

 Route::middleware('auth')->group(function () {
     Route::post('follow/{user}', 'FollowsController@store');
     Route::get('/home', 'HomeController@index')->name('home');
     Route::get('welcome/{post}','PostsController@show')->name('image.show');
     Route::get('/home', 'HomeController@index')->name('home');
     Route::get('/profile', 'HomeController@showprofile')->name('show.profile');
     Route::get('/profile/{profile}','HomeController@editprofile')->name('edit.profile');
     Route::patch('/profile', 'HomeController@update')->name('update.profile');
     Route::get('/post','PostsController@index')->name('index.post');
     Route::post('/post','PostsController@create')->name('create.post');
     Route::get('/test/{subject}','TestController@index')->name('test.index');
     Route::get('start-test/{test}','TestController@create')->name('test.create');
     Route::get('start/{user}','TestController@test')->name('test.start');
     Route::post('submit/{user}/{test}/{subject}/{score}', 'TestController@submit')->name('submit');
     Route::get('result','TestController@result');
 });
 Route::prefix('admin')->group(function (){
     Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
     Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
     Route::get('/register', 'Auth\AdminLoginController@showRegisterForm')->name('admin.register');
     Route::post('/register', 'Auth\AdminLoginController@register')->name('admin.register.submit');

     Route::get('/admin', 'AdminController@index')->name('admin.dashboard');
     Route::get('/', 'AdminController@usercount')->name('admin');
     Route::get('/logout', 'Auth\AdminLoginController@logout')->name('logout.admin');

     Route::get('/set','AdminController@setExam')->name('setExam.show');
     Route::get('/edit','AdminController@editExam')->name('editExam.show');
     Route::get('/edit-test/{test}','AdminController@editTest')->name('edit.test');
 });
 Route::post('create-exams/{subject}/{form}/{duration}','AdminController@examCreate' )->name('exam.create');
 Route::post('update-test/{test}/{subject}/{form}/{duration}','AdminController@updateTest' )->name('exam.edit');
