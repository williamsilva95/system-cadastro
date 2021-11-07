<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| CADASTRO Routes
|--------------------------------------------------------------------------
*/
Route::get('criar-cadastro','CadastroController@create');
Route::post('criar-cadastro','CadastroController@store');
Route::get('lista-cadastro','CadastroController@index');
Route::get('visualizar-cadastro/{id}','CadastroController@show');
Route::get('editar-cadastro/{id}','CadastroController@edit');
Route::post('editar-cadastro/{id}','CadastroController@update');
Route::get('deletar-cadastro/{id}','CadastroController@destroy');
Route::get('adicionar-gostei/{id}','CadastroController@adicionarGostei');
Route::get('adicionar-naogostei/{id}','CadastroController@adicionarNaoGostei');
Route::get('pesquisar','CadastroController@pesquisar');
Route::post('pesquisar','CadastroController@pesquisar');
Route::get('download/{id}','CadastroController@downloadFile');
Route::get('exportar','CadastroController@exportar');

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



