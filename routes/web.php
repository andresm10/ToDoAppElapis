<?php

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

/*
	Auth::routes();
*/

// Route to show the login form
Route::get('/', array('uses' => 'LoginUsersController@showLogin'))->name('login');//View de Login
Route::post('login', array('uses' => 'LoginUsersController@doLogin'));//Procesar formulario
Route::post('logout', array('uses' => 'LoginUsersController@doLogout'))->name('logout');//Logout


//Controladores de Usuarios
Route::get('users', array('uses' => 'UserController@users'))->name('users');//view form users list
Route::get('new_user', array('uses' => 'UserController@newUser'))->name('new_user');//View from new user
Route::post('crear_usuario', array('uses' => 'UserController@createUser'));//Insert new user
Route::get('cargar_usuario/{id}', array('uses' => 'UserController@cargarUsuario'))->name('cargar_usuario');//View from new user
Route::post('editar_usuario', array('uses' => 'UserController@editarUsuario'));//Insert new user


//Controladores de Olvide mi contraseña
Route::get('forgot_password', array('uses' => 'ForgotPasswordController@index'))->name('forgot_password');//view de olvide mi contraseña
Route::post('recover_password', array('uses' => 'ForgotPasswordController@recoverPassword'));//Insert new user
Route::get('new_password/{link}/{email}', array('uses' => 'ForgotPasswordController@newPassword'))->name('new_password');
Route::post('update_password', array('uses' => 'ForgotPasswordController@updatePassword'));//Insert new user


//ACTIVIDADES//
Route::get('actividades', array('uses' => 'ToDoListController@index'))->name('actividades');
Route::post('nueva_actividad', array('uses' => 'ToDoListController@nuevaActividad'));
Route::get('cargar_actividad/{id}', array('uses' => 'ToDoListController@cargarActividad'))->name('cargar_actividad');
Route::post('editar_actividad', array('uses' => 'ToDoListController@editarActividad'));
Route::get('eliminar_actividad/{id}', array('uses' => 'ToDoListController@desactivarActividad'))->name('eliminar_actividad');

//CATEGORIAS//
Route::get('categorias', array('uses' => 'CategoriasController@index'))->name('categorias');
Route::post('nueva_categoria', array('uses' => 'CategoriasController@nuevaCategoria'));
Route::get('cargar_categoria/{id}', array('uses' => 'CategoriasController@cargarCategoria'))->name('cargar_categoria');
Route::post('editar_categoria', array('uses' => 'CategoriasController@editarCategoria'));
Route::get('eliminar_categoria/{id}', array('uses' => 'CategoriasController@desactivarCategoria'))->name('eliminar_categoria');
Route::get('buscar_categorias', array('uses' => 'CategoriasController@buscarCategorias'))->name('buscar_categorias');