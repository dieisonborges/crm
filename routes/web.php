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

// Index
/*
Route::get('/', function () {
    return redirect('https://site.ecardume.com');
});
*/

Route::get('/', function () {
    $newSlug = str_slug('I am from ItSolutionStuff.com');
    
    dd($newSlug);
});
 
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

Route::get('user/{id}/convites', 'UserController@convites');
Route::post('user/conviteUpdate', 'UserController@conviteUpdate');



Route::resource('/categorias', 'CategoriaController');
Route::post('categorias/busca', 'CategoriaController@busca');

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
Route::get('clients/perfil', 'ClientController@perfil');
// Imagem Perfil
Route::get('clients/imagem', 'ClientController@imagem');
Route::post('clients/imagemUpdate', 'ClientController@imagemUpdate');

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
Route::get('convites/{id}/updateStatus/{status}', 'ConviteController@updateStatus');
Route::get('convites/reenviar/{id}', 'ConviteController@reenviar');

//Franquias
Route::resource('franquias', 'FranquiaController');
Route::post('franquias/busca', 'FranquiaController@busca');
Route::get('franquias/{id}/donos', 'FranquiaController@donos');
Route::post('franquias/donoUpdate', 'FranquiaController@donoUpdate');
Route::post('franquias/donoDestroy', 'FranquiaController@donoDestroy');

Route::get('franquias/enable/{id}', 'FranquiaController@enable');
Route::get('franquias/disable/{id}', 'FranquiaController@disable');


//Score
Route::resource('scores', 'ScoreController');
Route::post('scores/busca', 'ScoreController@busca');


//Conquistas
Route::resource('conquistas', 'ConquistaController');
Route::post('conquistas/busca', 'ConquistaController@busca');
Route::get('conquistas/{id}/user', 'ConquistaController@user');
Route::post('conquistas/userUpdate', 'ConquistaController@userUpdate');
Route::post('conquistas/userDestroy', 'ConquistaController@userDestroy');

//FranqueadoVip
Route::resource('franqueadoVip', 'FranqueadoVipController');
Route::post('franqueadoVip/busca', 'FranqueadoVipController@busca');

// UploadController
Route::resource('uploads', 'UploadController');
Route::post('uploads/destroy/{id}', 'UploadController@destroy');
Route::get('uploads/{id}/create/{area}', 'UploadController@create');

//Visualizar arquivos com segurança
Route::get('/storage/{fileName}', 'UploadController@fileStorageServe')
->where(['fileName' => '.*'])->name('storage.gallery.file');

//Imagens Publicas
Route::get('/storagePublic/{fileName}', 'UploadController@filePublicStorageServe')
->where(['fileName' => '.*'])->name('storage.gallery.file');


//Franqueados (Área dos Franqueados) -----------------------------------------------------------------------------

//Convites
Route::get('franqueados/convites', 'FranqueadoController@convite');
Route::get('franqueados/conviteShow/{id}', 'FranqueadoController@conviteShow');
Route::post('franqueados/convites/busca', 'FranqueadoController@conviteBusca');
Route::get('franqueados/convite/create', 'FranqueadoController@conviteCreate');
Route::post('franqueados/convite/conviteStore', 'FranqueadoController@conviteStore');

Route::get('franqueados/franquiaCreate/{id}', 'FranqueadoController@franquiaCreate');
Route::post('franqueados/franquiaStore', 'FranqueadoController@franquiaStore');

//--Config Franquias
Route::post('franqueados/{id}/configuracoesUpdate', 'FranqueadoController@configuracoesUpdate');
Route::get('franqueados/{id}/dashboard', 'FranqueadoController@dashboard');
Route::get('franqueados/{id}/configuracoes', 'FranqueadoController@configuracoes');
Route::get('franqueados/{id}/configuracoesEdit', 'FranqueadoController@configuracoesEdit');


Route::resource('franqueados', 'FranqueadoController');

//END Franqueados (Área dos Franqueados) -----------------------------------------------------------------------------


//Loja do Franqueado
//WooCommerce de Test
Route::get('lojaFranqueado', 'LojaFranqueadoController@index');


