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
 
// Login
Route::get('/', function () {
    return view('/auth/login');
});

// Auth - Controller Autenticacao
Auth::routes();

// HomeController - Dashboard - Painel Inicial
Route::get('home', 'HomeController@index')->name('home');

// Área de erros
Route::get('erro', 'ErroController@index')->name('erro');

// ContatoController
Route::resource('contato', 'ContatoController');
Route::post('contato/enviar', 'ContatoController@enviar');

// RoleController - Regras - Papeis
Route::resource('roles', 'RoleController');
Route::post('roles/busca', 'RoleController@busca');
Route::get('role/{id}/permissions', 'RoleController@permissions');
Route::post('role/permissionUpdate', 'RoleController@permissionUpdate');
Route::post('role/permissionDestroy', 'RoleController@permissionDestroy');

// PermissionController - Permissoes
Route::resource('permissions', 'PermissionController');
Route::post('permissions/busca', 'PermissionController@busca');
Route::get('permission/{id}/roles', 'PermissionController@roles');

Route::get('permission/createAuto', 'PermissionController@createAuto');
Route::post('permission/storeAuto', 'PermissionController@storeAuto');

// UserController - Permissoes
Route::resource('/users', 'UserController');
Route::post('users/busca', 'UserController@busca');
Route::post('users/updateActive', 'UserController@updateActive');
Route::get('user/{id}/roles', 'UserController@roles');
//Route::get('user/{id}/userroles', 'UserController@createUserRole');
Route::post('user/roleUpdate', 'UserController@roleUpdate');
Route::post('user/roleDestroy', 'UserController@roleDestroy');
//Setor User
Route::get('user/{id}/setors', 'UserController@setors');
Route::post('user/setorUpdate', 'UserController@setorUpdate');
Route::post('user/setorDestroy', 'UserController@setorDestroy');

//TEST
//Route::get('user/roleUpdateTest', 'UserController@roleUpdateTest');

Route::post('categorias/busca', 'CategoriaController@busca');
Route::get('categorias/dashboard', 'CategoriaController@dashboard');
Route::get('categorias/dashboard/{id}', 'CategoriaController@dashboardSistema');
Route::get('categorias/status/{id}/{status}/{sistema}', 'CategoriaController@status');
Route::resource('categorias', 'CategoriaController');


// TicketController
Route::resource('tickets', 'TicketController');
Route::post('tickets/busca', 'TicketController@busca');
Route::get('tickets/{id}/acao', 'TicketController@acao');
Route::post('tickets/storeAcao', 'TicketController@storeAcao');
Route::get('tickets/{id}/encerrar', 'TicketController@encerrar');
Route::post('tickets/storeEncerrar', 'TicketController@storeEncerrar');
Route::get('tickets/{status}/status', 'TicketController@status');
//Route::get('tickets/{id}/reabrir', 'TicketController@reabrir');
//Route::post('tickets/storeReabrir', 'TicketController@storeReabrir');

//Setor Ticket
Route::get('tickets/{id}/setors', 'TicketController@setors');
Route::post('tickets/setorUpdate', 'TicketController@setorUpdate');
Route::post('tickets/setorDestroy', 'TicketController@setorDestroy');


Route::resource('setors', 'SetorController');
Route::post('setors/busca', 'SetorController@busca');

// ClientController
Route::resource('clients', 'ClientController');
Route::post('clients/busca', 'ClientController@busca');
Route::get('clients/{id}/encerrar', 'ClientController@encerrar');
Route::post('clients/storeAcao', 'ClientController@storeAcao');
Route::post('clients/storeEncerrar', 'ClientController@storeEncerrar');
Route::get('clients/{status}/status', 'ClientController@status');
Route::get('clients/{id}/acao', 'ClientController@acao');

// AtendimentoController
//Route::resource('atendimentos/', 'AtendimentoController');
Route::get('atendimentos/{setor}/{id}/edit', 'AtendimentoController@edit');
Route::get('atendimentos/{setor}/{id}/show', 'AtendimentoController@show');
Route::get('atendimentos/{setor}/{id}/acao', 'AtendimentoController@acao');
Route::post('atendimentos/{setor}/{id}/update', 'AtendimentoController@update');

//Route::get('atendimentos/update/', 'AtendimentoController@update');

Route::post('atendimentos/{setor}/busca', 'AtendimentoController@busca');
Route::get('atendimentos/{setor}/buscaData', 'AtendimentoController@buscaData');
Route::get('atendimentos/{setor}/tickets/{categoria_id}/{status}/categoria', 'AtendimentoController@buscaStatusIdCategoria');
Route::get('atendimentos/{setor}/tickets/{status}/status', 'AtendimentoController@status');
Route::get('atendimentos/{setor}/tickets', 'AtendimentoController@index');
Route::post('atendimentos/storeAcao', 'AtendimentoController@storeAcao');
Route::get('atendimentos/{setor}/{id}/encerrar', 'AtendimentoController@encerrar');
Route::post('atendimentos/storeEncerrar', 'AtendimentoController@storeEncerrar');
Route::get('atendimentos/{setor}/{id}/reabrir', 'AtendimentoController@reabrir');
Route::post('atendimentos/storeReabrir', 'AtendimentoController@storeReabrir');

//Setor Atendimento
Route::get('atendimentos/{setor}/{id}/setors', 'AtendimentoController@setors');
Route::post('atendimentos/setorUpdate', 'AtendimentoController@setorUpdate');
Route::post('atendimentos/setorDestroy', 'AtendimentoController@setorDestroy');
Route::get('atendimentos/{setor}/dashboard', 'AtendimentoController@dashboard');
Route::get('atendimentos/{setor}/alocar', 'AtendimentoController@alocar');
Route::get('atendimentos/{setor}/{id}/alocarSetors', 'AtendimentoController@alocarSetors');
Route::post('atendimentos/alocarSetorUpdate', 'AtendimentoController@alocarSetorUpdate');

//LOGS
//Route::resource('logs', 'LogController');
Route::get('logs/acesso', 'LogController@acesso');
Route::get('logs/', 'LogController@index');
Route::get('logs/{id}', 'LogController@show');
Route::post('logs/busca', 'LogController@busca');


// Convites - Plataforma
Route::resource('convites', 'ConviteController');
Route::post('convites/busca', 'ConviteController@busca');

