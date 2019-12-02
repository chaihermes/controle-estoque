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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();             //gera rotas de login, de registro.

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/produtos/cadastrar', 'ProductController@viewForm');      //apenas criando a rota pra enviar pro formulário para cadastrar novo produto

Route::post('/produtos/cadastrar', 'ProductController@create');

Route::get('/produtos/atualizar/{id?}', 'ProductController@viewFormUpdate');      //criando a rota pra buscar o id do produto que será atualizado

Route::post('produtos/atualizar', 'ProductController@update');      //criando a rota que salva as informações atualizadas.

Route::get('/produtos', 'ProductController@viewAllProducts');

Route::get('/produtos/deletar/{id?}', 'ProductController@delete');