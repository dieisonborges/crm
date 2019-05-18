<?php

namespace App\Http\Controllers;

use App\FranquiaIntegrada;
use App\Franquia;
use App\User;
use App\Upload;
use App\Produto;
use App\Categoria;
use App\ProdutoPreco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Gate; 
use DB;


class SincronizarController extends Controller
{
    //
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="FranquiaIntegradaController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    /* ----------------------- END LOGS --------------------*/

    /*
    private $franquia;

    public function __construct(Franquia $franquia){
        $this->franquia = $franquia;
    }
    */

    public function all()
    {
        //Sincroniza tudo
        if(!(Gate::denies('read_sincronizar'))){
            
            //Sincroniza os Dados das Franquias
            $this->franquiasUpdate('all');

            //Sincroniza Uploads
            $this->uploadsUpdate();

            //Sincroniza Produtos
            $this->produtosUpdate();            

            //Sincroniza Galeria de Fotos dos Produtos
            $this->produtosGaleriaUpdate();

            //Sincroniza os Preços dos Produtos
            $this->produtoPrecosUpdate();

            //Sincroniza as Categorias
            $this->categoriasUpdate();

            //Sincroniza os Produtos de todos os franqueados
            $this->produtosFranqueadoUpdate('all');

            return redirect()->back()->with('success','Sincronização TOTAL efetuada com sucesso!');


        }
        else{
            return view('errors.403');
        }
    }




    /* ******************************************************************************* */
    /* ------------------------------- Franquias -------------------- */
    /* ******************************************************************************* */



    public function franquias()
    {
        //
        if(!(Gate::denies('read_sincronizar'))){
            $franquias = Franquia::orderBy('id')
                                        ->get();  

            //LOG -----------------------------------------------------
            $this->log("franquiaIntegrada.index");
            //-----------------------------------------------------

            //Conecta nas lojas remotas
            $franquias_remotas = DB::connection('mysql_loja')
                                        ->table('franquias')
                                        ->orderBy('id_7p')
                                        ->get();

            return  view('sincronizar.franquia', 
                    array(

                        'franquias' => $franquias,
                        'franquias_remotas' => $franquias_remotas,
                        'buscar' => null

                    ));
        }
        else{
            return view('errors.403');
        }
    }


    public function franquiasUpdate($id)
    {
        //
        if((!(Gate::denies('update_sincronizar')))or(!(Gate::denies('update_franqueado')))){

            if($id=='all'){
                $franquias = Franquia::get();
            }else{
                //Verifica se o Franqueado pode acessar a franquia
                $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

                if($franquia){
                    //Seleciona a franquia
                    $franquias = Franquia::where('id', $id)->get();
                }else{
                    return view('errors.403');
                }
            }
            

            foreach ($franquias as $franquia) {
                $franquia_remota = DB::connection('mysql_loja')
                                        ->table('franquias')
                                        ->where('id_7p', $franquia->id)
                                        ->first();
                if($franquia_remota){
                    $status =       DB::connection('mysql_loja')
                                        ->table('franquias')
                                        ->where('id_7p', $franquia->id)
                                        ->update(array(
                                            'loja_url' => $franquia->loja_url,
                                            'loja_url_alternativa' => $franquia->loja_url_alternativa,
                                            'codigo_franquia' => $franquia->codigo_franquia,
                                            'nome' => $franquia->nome,
                                            'slogan' => $franquia->slogan,
                                            'descricao' => $franquia->descricao,
                                            'url_site' => $franquia->url_site,
                                            'url_blog' => $franquia->url_blog,
                                            'status' => $franquia->status,
                                            'cnpj' => $franquia->cnpj,
                                            'telefone' => $franquia->telefone,
                                            'email' => $franquia->email,
                                            'endereco' => $franquia->endereco,
                                            'endereco_numero' => $franquia->endereco_numero,
                                            'endereco_bairro' => $franquia->endereco_bairro,
                                            'endereco_cidade' => $franquia->endereco_cidade,
                                            'endereco_estado' => $franquia->endereco_estado,
                                            'endereco_cep' => $franquia->endereco_cep,
                                            'lucro' => $franquia->lucro,
                                        ));
                    if($status){
                       //return redirect('franquiasIntegrada/')->with('danger', 'Houve um problema!'); 
                    }

                }else{
                    $status =    DB::connection('mysql_loja')
                                        ->table('franquias')
                                        ->insert(array(
                                            'id' => $franquia->id,
                                            /* -----------SYNC feito por aqui-- */
                                            'id_7p' => $franquia->id,
                                            /* ------------------- */
                                            'loja_url' => $franquia->loja_url,
                                            'loja_url_alternativa' => $franquia->loja_url_alternativa,
                                            'codigo_franquia' => $franquia->codigo_franquia,
                                            'nome' => $franquia->nome,
                                            'slogan' => $franquia->slogan,
                                            'descricao' => $franquia->descricao,
                                            'url_site' => $franquia->url_site,
                                            'url_blog' => $franquia->url_blog,
                                            'status' => $franquia->status,
                                            'cnpj' => $franquia->cnpj,
                                            'telefone' => $franquia->telefone,
                                            'email' => $franquia->email,
                                            'endereco' => $franquia->endereco,
                                            'endereco_numero' => $franquia->endereco_numero,
                                            'endereco_bairro' => $franquia->endereco_bairro,
                                            'endereco_cidade' => $franquia->endereco_cidade,
                                            'endereco_estado' => $franquia->endereco_estado,
                                            'endereco_cep' => $franquia->endereco_cep,
                                            'lucro' => $franquia->lucro,
                                        ));
                    if(!$status){
                       //return redirect('franquiasIntegrada/')->with('danger', 'Houve um problema!'); 
                    }

                }
            }


            //LOG -----------------------------------------------------
            $this->log("franquiaIntegrada.sync");
            //-----------------------------------------------------

            return redirect()->back()->with('success','Franquia atualizada com sucesso!');
            
        }
        else{
            return view('errors.403');
        }
    }

    /* ******************************************************************************* */
    /* --------------------------- FIM Franquias -------------------- */
    /* ******************************************************************************* */

    /* ******************************************************************************* */
    /* ------------------------------- Uploads -------------------- */
    /* ******************************************************************************* */

    public function uploads(Request $request)
    {
        //
        if(!(Gate::denies('read_sincronizar'))){

            if($request){
                $buscaInput=$request->input('busca');
            }else{
                $buscaInput=""; 
            }
            
            //Uploadsa Locais
            $uploads = Upload::where('titulo', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('link', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('dir', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('ext', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('nome', 'LIKE', '%'.$buscaInput.'%')      
			                    ->orderBy('uploads.id', 'DESC')
			                    ->get();
            

            //Conecta nas lojas remotas
            $uploads_remotos = DB::connection('mysql_loja')
                                ->table('uploads')
                                ->select('uploads.*')                      
                                ->where('titulo', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('link', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('dir', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('ext', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('nome', 'LIKE', '%'.$buscaInput.'%')
                                ->orderBy('id_7p', 'DESC')
                                ->get();

            //LOG -------------------------------------------------
            $this->log("upload.preco.sync.index");
            //-----------------------------------------------------
            

            return  view('sincronizar.upload', 
                                        array(

                                            'uploads' => $uploads,
                                            'uploads_remotos' => $uploads_remotos,
                                            'buscar' => null

                                        ));
        }
        else{
            return view('errors.403');
        }
    }

    public function uploadsUpdate()
    {
        //
        if(!(Gate::denies('update_sincronizar'))){             

            /* --------------------------- Sincroniza Uploads ------------------ */
            $uploads = Upload::all();


            foreach ($uploads as $upload) {
                
                //Conecta nas lojas remotas
                $upload_remoto = DB::connection('mysql_loja')
                                        ->table('uploads')
                                        ->where('id_7p', $upload->id)
                                        ->first();


                //Verifica se existe o preço do upload remoto
                //Se existir ele atualiza
                if($upload_remoto){
                    $status =       DB::connection('mysql_loja')
                                        ->table('uploads')
                                        ->where('id_7p', $upload->id)
                                        ->update(array(
                                            'titulo' => $upload->titulo,
                                            'link' => $upload->link,
                                            'dir' => $upload->dir,
                                            'ext' => $upload->ext,
                                            'tipo' => $upload->tipo,
                                            'nome' => $upload->nome,
                                            'tam' => $upload->tam

                                        ));
                    if($status){
                       //return redirect('franquiasIntegrada/')->with('danger', 'Houve um problema!'); 
                    }
                //Caso não tenha ele cria
                }else{
                    $status =    DB::connection('mysql_loja')
                                        ->table('uploads')
                                        ->insert(array(
                                            'id' => $upload->id,
                                            /* -----------SYNC feito por aqui-- */
                                            'id_7p' => $upload->id,
                                            /* ------------------- */
                                            'titulo' => $upload->titulo,
                                            'link' => $upload->link,
                                            'dir' => $upload->dir,
                                            'ext' => $upload->ext,
                                            'tipo' => $upload->tipo,
                                            'nome' => $upload->nome,
                                            'tam' => $upload->tam
                                        ));
                    if(!$status){
                       //return redirect('franquiasIntegrada/')->with('danger', 'Houve um problema!'); 
                    }

                }
            }



            /* --------------------------- END Sincroniza Uploads ------------------ */

            //LOG -------------------------------------------------
            $this->log("uploads.sync");
            //-----------------------------------------------------

            return redirect('uploadsSincronizar/')->with('success', 'Sincronizado com sucesso!');
            
        }
        else{
            return view('errors.403');
        }
    }

    /* ******************************************************************************* */
    /* --------------------------- FIM Uploads -------------------- */
    /* ******************************************************************************* */



    /* ******************************************************************************* */
    /* ------------------------------- Produtos -------------------- */
    /* ******************************************************************************* */

    public function produtos(Request $request)
    {
        //
        if(!(Gate::denies('read_sincronizar'))){

            if($request){
                $buscaInput=$request->input('busca');
            }else{
                $buscaInput=""; 
            }
            
            //Produtosa Locais
            $produtos = Produto::where('titulo', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('palavras_chave', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('sku', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')      
			                    ->orderBy('produtos.id', 'DESC')
			                    ->get();
            

            //Conecta nas lojas remotas
            $produtos_remotos = DB::connection('mysql_loja')
                                ->table('produtos')
                                ->select('produtos.*')                      
                                ->where('titulo', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('palavras_chave', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('sku', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                                ->orderBy('id_7p', 'DESC')
                                ->get();

            //LOG -------------------------------------------------
            $this->log("produto.preco.sync.index");
            //-----------------------------------------------------
            

            return  view('sincronizar.produto', 
                                        array(

                                            'produtos' => $produtos,
                                            'produtos_remotos' => $produtos_remotos,
                                            'buscar' => null

                                        ));
        }
        else{
            return view('errors.403');
        }
    }

    public function produtosUpdate()
    {
        //
        if(!(Gate::denies('update_sincronizar'))){  

            //Sincroniza Uploads
            $this->uploadsUpdate();           

            /* --------------------------- Sincroniza os Produtos ------------------ */
            $produtos = Produto::all();


            foreach ($produtos as $produto) {
                
                //Conecta nas lojas remotas
                $produto_remoto = DB::connection('mysql_loja')
                                        ->table('produtos')
                                        ->where('id_7p', $produto->id)
                                        ->first();


                //Verifica se existe o preço do produto remoto
                //Se existir ele atualiza
                if($produto_remoto){
                    $status =       DB::connection('mysql_loja')
                                        ->table('produtos')
                                        ->where('id_7p', $produto->id)
                                        ->update(array(
                                            'upload_id' => $produto->upload_id,
                                            'sku' => $produto->sku,
                                            'titulo' => $produto->titulo,
                                            'palavras_chave' => $produto->palavras_chave,
                                            'descricao' => $produto->descricao,
                                            'status' => $produto->status,
                                            'altura' => $produto->altura,
                                            'largura' => $produto->largura,
                                            'comprimento' => $produto->comprimento,
                                            'peso' => $produto->peso,
                                            'link_referencia' => $produto->link_referencia,
                                            /*--------REMOVER - Foi Modificado Itens de Layout----------*/
                                            'preco' => "0.0",
                                            'frete_fixo' => "0.0",
                                            'is_new' => "0",
                                            'desconto' => "0",

                                        ));
                    if($status){
                       //return redirect('franquiasIntegrada/')->with('danger', 'Houve um problema!'); 
                    }
                //Caso não tenha ele cria
                }else{
                    $status =    DB::connection('mysql_loja')
                                        ->table('produtos')
                                        ->insert(array(
                                            'id' => $produto->id,
                                            /* -----------SYNC feito por aqui-- */
                                            'id_7p' => $produto->id,
                                            /* ------------------- */
                                            'upload_id' => $produto->upload_id,
                                            'sku' => $produto->sku,
                                            'titulo' => $produto->titulo,
                                            'palavras_chave' => $produto->palavras_chave,
                                            'descricao' => $produto->descricao,
                                            'status' => $produto->status,
                                            'altura' => $produto->altura,
                                            'largura' => $produto->largura,
                                            'comprimento' => $produto->comprimento,
                                            'peso' => $produto->peso,
                                            'link_referencia' => $produto->link_referencia,
                                            /*--------REMOVER - Foi Modificado Itens de Layout----------*/
                                            'preco' => "0.0",
                                            'frete_fixo' => "0.0",
                                            'is_new' => "0",
                                            'desconto' => "0",
                                        ));
                    if(!$status){
                       //return redirect('franquiasIntegrada/')->with('danger', 'Houve um problema!'); 
                    }

                }
            }


            //Sincroniza Galeria de Fotos dos Produtos
            $this->produtosGaleriaUpdate();

            /* --------------------------- END Sincroniza os Produtos ------------------ */

            //LOG -------------------------------------------------
            $this->log("produtos.sync");
            //-----------------------------------------------------

            return redirect('produtosSincronizar/')->with('success', 'Sincronizado com sucesso!');
            
        }
        else{
            return view('errors.403');
        }
    }

    /* ******************************************************************************* */
    /* --------------------------- FIM Produtos -------------------- */
    /* ******************************************************************************* */


    /* ******************************************************************************* */
    /* ------------------------------- Produtos Galeria -------------------- */
    /* ******************************************************************************* */


    public function produtosGaleriaUpdate()
    {
        //
        if(!(Gate::denies('update_sincronizar'))){             

            /* --------------------------- Sincroniza Galeria Produtos ------------------ */
            $galeria_produtos = DB::table('galeria_produto')->get();
                                        


            foreach ($galeria_produtos as $galeria_produto) {
                
                //Conecta nas lojas remotas
                $galeria_produto_remoto = DB::connection('mysql_loja')
                                        ->table('galeria_produto')
                                        ->where('id_7p', $galeria_produto->id)
                                        ->first();


                //Verifica se existe o preço do galeria_produto remoto
                //Se existir ele atualiza
                if($galeria_produto_remoto){
                    $status =       DB::connection('mysql_loja')
                                        ->table('galeria_produto')
                                        ->where('id_7p', $galeria_produto->id)
                                        ->update(array(
                                            'upload_id' => $galeria_produto->upload_id,
                                            'produto_id' => $galeria_produto->produto_id

                                        ));
                    if($status){
                       //return redirect('franquiasIntegrada/')->with('danger', 'Houve um problema!'); 
                    }
                //Caso não tenha ele cria
                }else{
                    $status =    DB::connection('mysql_loja')
                                        ->table('galeria_produto')
                                        ->insert(array(
                                            'id' => $galeria_produto->id,
                                            /* -----------SYNC feito por aqui-- */
                                            'id_7p' => $galeria_produto->id,
                                            /* ------------------- */
                                            'upload_id' => $galeria_produto->upload_id,
                                            'produto_id' => $galeria_produto->produto_id
                                        ));
                    if(!$status){
                       //return redirect('franquiasIntegrada/')->with('danger', 'Houve um problema!'); 
                    }

                }
            }



            /* --------------------------- END Sincroniza Galeria Produtos  --------- */

            //LOG -------------------------------------------------
            $this->log("produtos.sync");
            //-----------------------------------------------------

            return redirect('produtosSincronizar/')->with('success', 'Sincronizado com sucesso!');
            
        }
        else{
            return view('errors.403');
        }
    }

    /* ******************************************************************************* */
    /* --------------------------- FIM Produtos Galeria -------------------- */
    /* ******************************************************************************* */

    /* ******************************************************************************* */
    /* ------------------------------- Preços de Produtos -------------------- */
    /* ******************************************************************************* */

    public function produtoPrecos(Request $request)
    {
        //
        if(!(Gate::denies('read_sincronizar'))){

            if($request){
                $buscaInput=$request->input('busca');
            }else{
                $buscaInput=""; 
            }
            

            $produto_precos = DB::table('produto_precos')
                    ->select(array(
                        'produto_precos.*',
                        'produtos.sku',
                        'produtos.titulo',
                        'fornecedors.nome_fantasia'
                     ))
                    ->join('produtos', 'produto_precos.produto_id', '=', 'produtos.id') 
                    ->join('fornecedors', 'produto_precos.fornecedor_id', '=', 'fornecedors.id')  
                    ->where('produtos.titulo', 'LIKE', '%'.$buscaInput.'%')
                    ->orwhere('produtos.palavras_chave', 'LIKE', '%'.$buscaInput.'%')
                    ->orwhere('produtos.sku', 'LIKE', '%'.$buscaInput.'%')
                    ->orwhere('produtos.descricao', 'LIKE', '%'.$buscaInput.'%')                  
                    ->orderBy('produto_precos.id', 'DESC')
                    ->get();

            

            //LOG -----------------------------------------------------
            $this->log("produto.preco.sync.index");
            //-----------------------------------------------------

            //Conecta nas lojas remotas
            $produto_precos_remotos = DB::connection('mysql_loja')
                                        ->table('produto_precos')
                                        ->select(array(
                                            'produto_precos.*',
                                            'produtos.sku',
                                            'produtos.titulo',
                                         ))
                                        ->join('produtos', 'produto_precos.produto_id', '=', 'produtos.id') 
                                        ->where('produtos.titulo', 'LIKE', '%'.$buscaInput.'%')
                                        ->orwhere('produtos.palavras_chave', 'LIKE', '%'.$buscaInput.'%')
                                        ->orwhere('produtos.sku', 'LIKE', '%'.$buscaInput.'%')
                                        ->orwhere('produtos.descricao', 'LIKE', '%'.$buscaInput.'%')                  
                                        ->orderBy('id_7p', 'DESC')
                                        ->get();
            

            return  view('sincronizar.produto_preco', 
                                                array(

                                                    'produto_precos' => $produto_precos,
                                                    'produto_precos_remotos' => $produto_precos_remotos,
                                                    'buscar' => null

                                                ));
        }
        else{
            return view('errors.403');
        }
    }

    public function produtoPrecosUpdate()
    {
        //
        if(!(Gate::denies('update_sincronizar'))){

            //Sincroniza Uploads
            $this->uploadsUpdate();

            //Sincroniza Produtos
            $this->produtosUpdate();            

            //Sincroniza Galeria de Fotos dos Produtos
            $this->produtosGaleriaUpdate();

            /* ---------------------------- Sincroniza Preço de Produto -------------- */
            $produto_precos = ProdutoPreco::where('status', 1)->get();

            foreach ($produto_precos as $produto_preco) {

                //dd($produto_preco);
                
                //Conecta nas lojas remotas
                $produto_preco_remoto = DB::connection('mysql_loja')
                                        ->table('produto_precos')
                                        ->where('id_7p', $produto_preco->id)
                                        ->first();

                //Verifica se existe o preço do produto remoto
                //Se existir ele atualiza
                if($produto_preco_remoto){
                    $status =       DB::connection('mysql_loja')
                                        ->table('produto_precos')
                                        ->where('id_7p', $produto_preco->id)
                                        ->update(array(
                                            'status' => $produto_preco->status,
                                            'produto_id' => $produto_preco->produto_id,
                                            'quantidade' => $produto_preco->quantidade,
                                            'unidade_medida' => $produto_preco->unidade_medida,
                                            'preco' => $produto_preco->preco,
                                            'frete_preco' => $produto_preco->frete_preco,
                                            'frete_tipo' => $produto_preco->frete_tipo,
                                            'moeda' => $produto_preco->moeda,
                                            'taxa_plataforma' => $produto_preco->taxa_plataforma,
                                            'impostos' => $produto_preco->impostos,                                            
                                        ));
                    if($status){
                       //return redirect('franquiasIntegrada/')->with('danger', 'Houve um problema!'); 
                    }
                //Caso não tenha ele cria
                }else{
                    $status =    DB::connection('mysql_loja')
                                        ->table('produto_precos')
                                        ->insert(array(
                                            'id' => $produto_preco->id,
                                            /* -----------SYNC feito por aqui-- */
                                            'id_7p' => $produto_preco->id,
                                            /* ------------------- */
                                            'status' => $produto_preco->status,
                                            'produto_id' => $produto_preco->produto_id,
                                            'quantidade' => $produto_preco->quantidade,
                                            'unidade_medida' => $produto_preco->unidade_medida,
                                            'preco' => $produto_preco->preco,
                                            'frete_preco' => $produto_preco->frete_preco,
                                            'frete_tipo' => $produto_preco->frete_tipo,
                                            'moeda' => $produto_preco->moeda,
                                            'taxa_plataforma' => $produto_preco->taxa_plataforma,
                                            'impostos' => $produto_preco->impostos, 
                                        ));
                    if(!$status){
                       //return redirect('franquiasIntegrada/')->with('danger', 'Houve um problema!'); 
                    }

                }
            }
            /* --------------------------------- END PRECO de Produto ------------------- */




            //LOG -----------------------------------------------------
            $this->log("produtoPrecos.sync");
            //-----------------------------------------------------

            return redirect('produtoPrecosSincronizar/')->with('success', 'Sincronizado com sucesso!');
            
        }
        else{
            return view('errors.403');
        }
    }

    /* ******************************************************************************* */
    /* --------------------------- FIM Preços de Produtos -------------------- */
    /* ******************************************************************************* */

    /* ******************************************************************************* */
    /* ------------------------------- Categorias -------------------- */
    /* ******************************************************************************* */


    public function categoriasUpdate()
    {
        //
        if(!(Gate::denies('update_sincronizar'))){

            //Lista todas as categorias
            $categorias = Categoria::get();

            foreach ($categorias as $categoria) {
                $categoria_remota = DB::connection('mysql_loja')
                                        ->table('categorias')
                                        ->where('id_7p', $categoria->id)
                                        ->first();
                if($categoria_remota){
                    $status =       DB::connection('mysql_loja')
                                        ->table('categorias')
                                        ->where('id_7p', $categoria->id)
                                        ->update(array(
                                            'nome' => $categoria->nome,
                                            'descricao' => $categoria->descricao,
                                            'valor' => $categoria->valor,
                                        ));
                    if($status){
                       //return redirect('categoriasIntegrada/')->with('danger', 'Houve um problema!'); 
                    }

                }else{
                    $status =    DB::connection('mysql_loja')
                                        ->table('categorias')
                                        ->insert(array(
                                            'id' => $categoria->id,
                                            /* -----------SYNC feito por aqui-- */
                                            'id_7p' => $categoria->id,
                                            /* ------------------------------- */
                                            'nome' => $categoria->nome,
                                            'descricao' => $categoria->descricao,
                                            'valor' => $categoria->valor,
                                        ));
                    if(!$status){
                       //return redirect('categoriasIntegrada/')->with('danger', 'Houve um problema!'); 
                    }

                }
            }




            //LOG ----------------------------------------------------------------------------------------
            $this->log("categoria.sync");
            //--------------------------------------------------------------------------------------

            return redirect('categorias/')->with('success', 'Sincronizado com sucesso!');
            
        }
        else{
            return view('errors.403');
        }
    }

    /* ******************************************************************************* */
    /* --------------------------- FIM Categorias -------------------- */
    /* ******************************************************************************* */

    /* ******************************************************************************* */
    /* --------------------- Produtos Selecionados Pelo Franqueado -------------------- */
    /* ******************************************************************************* */


    public function produtosFranqueadoUpdate($id)
    {
        //
        if((!(Gate::denies('update_sincronizar')))or(!(Gate::denies('update_franqueado')))){


            if($id=='all'){
                $franquias = Franquia::get();
            }else{
                //Verifica se o Franqueado pode acessar a franquia
                $franquia = Auth::user()
                            ->franquia()
                            ->where('franquias.id', $id)
                            ->first(); 

                if($franquia){
                    //Seleciona a franquia
                    $franquias = Franquia::where('id', $id)->get();
                }else{
                    return view('errors.403');
                }
            }

            foreach ($franquias as $franquia) {                                               

            /* ------------- Sincroniza os Produtos ----------------------- */
                    $produtos = DB::table('produto_franquia')
                                    ->where('franquia_id', $franquia->id)
                                    ->get();


                    foreach ($produtos as $produto) {
                        
                        //Conecta nas lojas remotas
                        $produto_remoto = DB::connection('mysql_loja')
                                                ->table('produto_franquia')
                                                ->where('id_7p', $produto->id)
                                                ->first();

                        //Verifica se existe o preço do produto remoto
                        //Se existir ele atualiza
                        if($produto_remoto){
                            $status =       DB::connection('mysql_loja')
                                                ->table('produto_franquia')
                                                ->where('id_7p', $produto->id)
                                                ->update(array(
                                                    'lucro' => $produto->lucro
                                                ));
                            if($status){
                               //return redirect('franquiasIntegrada/')->with('danger', 'Houve um problema!'); 
                            }
                        //Caso não tenha ele cria
                        }else{
                            $status =    DB::connection('mysql_loja')
                                                ->table('produto_franquia')
                                                ->insert(array(
                                                    'id' => $produto->id,
                                                    /* -----------SYNC feito por aqui-- */
                                                    'id_7p' => $produto->id,
                                                    /* ------------------------------- */
                                                    'franquia_id' => $produto->franquia_id,
                                                    'produto_id' => $produto->produto_id,
                                                    'lucro' => $produto->lucro
                                                ));
                            if(!$status){
                            }

                        }
                    }

                    //Verifica se o produto foi removido e remove da franquia remota
                    
                    $produtos_remotos = DB::connection('mysql_loja')
                                            ->table('produto_franquia')
                                            ->where('franquia_id', $franquia->id)
                                            ->get();

                    foreach ($produtos_remotos as $produto_remoto) {

                        $produto = DB::table('produto_franquia')
                                    ->where('id', $produto_remoto->id_7p)
                                    ->where('franquia_id', $franquia->id)
                                    ->first();
                        if(!$produto){
                                DB::connection('mysql_loja')
                                                ->table('produto_franquia')
                                                ->where('id', $produto_remoto->id_7p)
                                                ->where('franquia_id', $franquia->id)
                                                ->delete();

                        }

                    }
                    
            //LOG -------------------------------------------------------------------------
            $this->log("produtoPrecos.franqueado.sync");
            //------------------------------------------------------------------------------

            return redirect('/franqueados/'.$franquia->id.'/produtosFranqueado')->with('success', 'Sincronizado com sucesso!');


            /* ----------------------- END Sincroniza os Produtos ----------- */
        
            }
        }
        else{
            return view('errors.403');
        }
    }

    /* ******************************************************************************* */
    /* ----------------- FIM Produtos Selecionados Pelo Franqueado -------------------- */
    /* ******************************************************************************* */


}
