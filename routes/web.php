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
Route::get('/', function () {
    return redirect('https://site.ecardume.com');
});
 
// Login
/*
Route::get('/', function () {
    return view('/auth/login');
});
*/

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

//Produtos
Route::resource('produtos', 'ProdutoController');
Route::post('produtos/busca', 'ProdutoController@busca');

// Imagem Produtos
Route::get('produtos/{id_produto}/imagemValor/{id_imagem}', 'ProdutoController@imagemValor');
Route::post('produtos/imagemValorUpdate', 'ProdutoController@imagemValorUpdate');


Route::get('produtos/{id}/imagem', 'ProdutoController@imagem');
Route::post('produtos/imagemUpdate', 'ProdutoController@imagemUpdate');
Route::post('produtos/imagemDestroy/{id}', 'ProdutoController@imagemDestroy');
Route::get('produtos/imagemPrincipal/{imagem_id}/{produto_id}', 'ProdutoController@imagemPrincipal');


Route::get('produtos/{id}/categorias', 'ProdutoController@categoria');
Route::post('produtos/categoriaUpdate', 'ProdutoController@categoriaUpdate');
Route::post('produtos/categoriaDestroy', 'ProdutoController@categoriaDestroy');


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

//Fornecedor
Route::get('fornecedor/{id}/usuarios', 'FornecedorController@usuarios');
Route::post('fornecedor/usuarioUpdate', 'FornecedorController@usuarioUpdate');
Route::post('fornecedor/usuarioDestroy', 'FornecedorController@usuarioDestroy');
Route::resource('fornecedor', 'FornecedorController');
Route::post('fornecedor/busca', 'FornecedorController@busca');

//Orçamento
Route::post('orcamento/busca', 'OrcamentoController@busca');

Route::get('orcamento/{id}/item', 'OrcamentoController@item');
Route::post('orcamento/itemStore', 'OrcamentoController@itemStore');

Route::get('orcamento/{id}/itemLote', 'OrcamentoController@itemLote');
Route::post('orcamento/itemLoteStore', 'OrcamentoController@itemLoteStore');

Route::get('orcamento/{id}/itemEdit', 'OrcamentoController@itemEdit');
Route::post('orcamento/itemUpdate', 'OrcamentoController@itemUpdate');
Route::post('orcamento/itemDestroy', 'OrcamentoController@itemDestroy');
Route::get('orcamento/{id}/enviar', 'OrcamentoController@enviar');
Route::get('orcamento/{id}/cancelar', 'OrcamentoController@cancelar');

Route::resource('orcamento', 'OrcamentoController');


/* -------------------------Área Interna do Fornecedor ----------------------------------- */
Route::get('fornecedorArea/dashboard', 'FornecedorAreaController@dashboard');
Route::get('fornecedorArea/orcamentos', 'FornecedorAreaController@orcamentos');
Route::get('fornecedorArea/orcamentoCreate', 'FornecedorAreaController@orcamentoCreate');
Route::post('fornecedorArea/orcamentoStore', 'FornecedorAreaController@orcamentoStore');
Route::get('fornecedorArea/orcamentoShow/{id}', 'FornecedorAreaController@orcamentoShow');
Route::get('fornecedorArea/orcamentoEdit/{id}', 'FornecedorAreaController@orcamentoEdit');
Route::post('fornecedorArea/orcamentoUpdate', 'FornecedorAreaController@orcamentoUpdate');
Route::get('fornecedorArea/orcamentoFinalizar/{id}', 'FornecedorAreaController@orcamentoFinalizar');

Route::get('fornecedorArea/orcamentoItemLote/{id}', 'FornecedorAreaController@orcamentoItemLote');
Route::post('fornecedorArea/orcamentoItemLoteStore', 'FornecedorAreaController@orcamentoItemLoteStore');

Route::post('fornecedorArea/orcamentoItemDestroy', 'FornecedorAreaController@orcamentoItemDestroy');

//Excel
Route::get('fornecedorArea/orcamentoShowExcel/{id}', 'FornecedorAreaController@orcamentoShowExcel');
//PDF
Route::get('fornecedorArea/orcamentoShowPdf/{id}', 'FornecedorAreaController@orcamentoShowPdf');

/* -------------------------END Área Interna do Fornecedor ----------------------------------- */


/* --------------------------------- Orçamento Fonecedor - SEGURANCA VIA TOKEN --------------------- */
Route::get('orcamento/fornecedor/{token}', 'OrcamentoController@fornecedor');
Route::post('orcamento/fornecedorUpdate', 'OrcamentoController@fornecedorUpdate');
Route::get('orcamento/fornecedorFinalizar/{token}', 'OrcamentoController@fornecedorFinalizar');
/* --------------------------------- END Orçamento Fonecedor - SEGURANCA VIA TOKEN --------------------- */


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
Route::get('franqueados/{id}/produtosFranqueado', 'FranqueadoController@produtosFranqueado');
Route::get('franqueados/{id}/produtosRemover/{id_produto}', 'FranqueadoController@produtosRemover');
Route::get('franqueados/{id}/produtosAdicionar/{id_produto}', 'FranqueadoController@produtosAdicionar');
Route::get('franqueados/{id}/produtosLucro/{id_produto}', 'FranqueadoController@produtosLucro');
Route::post('franqueados/{id}/produtosLucroUpdate', 'FranqueadoController@produtosLucroUpdate');

Route::post('franqueados/{id}/produtosFranqueadoBusca', 'FranqueadoController@produtosFranqueadoBusca');

Route::get('franqueados/produtos', 'FranqueadoController@produtos');
Route::post('franqueados/produtos/busca', 'FranqueadoController@produtosBusca');
Route::get('franqueados/produtos/{id}', 'FranqueadoController@produtosShow');
Route::resource('franqueados', 'FranqueadoController');

//Prospectos
Route::get('franqueados/{id}/prospectos', 'FranqueadoController@prospectos');
Route::post('franqueados/{id}/prospectosBusca', 'FranqueadoController@prospectosBusca');
Route::get('franqueados/{id}/prospectos/{prospecto_id}', 'FranqueadoController@prospectoShow');





//Produto Preços

Route::get('produtoPrecos/enable/{id}', 'ProdutoPrecoController@enable');
Route::get('produtoPrecos/disable/{id}', 'ProdutoPrecoController@disable');

Route::get('produtoPrecos/{id}/orcamento', 'ProdutoPrecoController@orcamento');
Route::post('produtoPrecos/orcamentoCreate', 'ProdutoPrecoController@orcamentoCreate');

Route::resource('produtoPrecos', 'ProdutoPrecoController');
Route::post('produtoPrecos/busca', 'ProdutoPrecoController@busca');




//END Franqueados (Área dos Franqueados) -----------------------------------------------------------------------------


/* -------------- ***** SINCRONIZAR LOJAS ***** ----------------------------- */

//Categorias
Route::get('sincronizarTudo', 'SincronizarController@all');

//Categorias
Route::get('categoriasSincronizarUpdate', 'SincronizarController@categoriasUpdate');

//Preço de Produto
//Route::get('produtoPrecosSincronizar', 'ProdutoPrecoController@sync');
//Route::get('produtoPrecosSincronizarUpdate', 'ProdutoPrecoController@syncUpdate');

//Uploads
Route::get('uploadsSincronizar', 'SincronizarController@uploads');
Route::get('uploadsSincronizarUpdate', 'SincronizarController@uploadsUpdate');

//Produtos
Route::get('produtosSincronizar', 'SincronizarController@produtos');
Route::get('produtosSincronizarUpdate', 'SincronizarController@produtosUpdate');

//Preço de Produto
Route::get('produtoPrecosSincronizar', 'SincronizarController@produtoPrecos');
Route::get('produtoPrecosSincronizarUpdate', 'SincronizarController@produtoPrecosUpdate');

//Produto do Franqueado
Route::get('produtosFranqueadoUpdate/{id}', 'SincronizarController@produtosFranqueadoUpdate');

//Franquias
Route::get('franquiasSincronizar', 'SincronizarController@franquias');
Route::get('franquiasSincronizarUpdate/{id}', 'SincronizarController@franquiasUpdate');

//Prospectos
Route::get('prospectosSincronizar', 'SincronizarController@listaProspectos');
Route::get('prospectosSincronizarUpdate', 'SincronizarController@listaProspectosUpdate');



//Franquia Integrada
//Route::post('franquiasIntegrada/busca', 'FranquiaIntegradaController@busca');
//Route::get('franquiasIntegrada/sync/{id}', 'FranquiaIntegradaController@sync');
//Route::resource('franquiasIntegrada', 'FranquiaIntegradaController');

//Lista de Prospectos
Route::resource('listaProspectos', 'ListaProspectoController');

// FaturaController
Route::resource('fatura', 'FaturaController');

//Loja do Franqueado
Route::get('lojaFranqueado', 'LojaFranqueadoController@index');

