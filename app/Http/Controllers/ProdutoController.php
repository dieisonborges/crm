<?php

namespace App\Http\Controllers;

use App\Produto; 
use App\Upload; 
use App\Categoria; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Gate;
use DB;

//Log
use App\Http\Controllers\Log;
use App\Http\Controllers\LogController;

class ProdutoController extends Controller
{
    
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="ProdutoController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;
    }

    /* ----------------------- END LOGS --------------------*/

    private $produto;

    public function __construct(Produto $produto){
        $this->produto = $produto;
    }

    private function skuGenerate()
    {
        
        $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';

        $protocolo = $chars[rand (0 , 24)];
        $protocolo .= $chars[rand (0 , 24)];
        $protocolo .= rand (0 , 9);
        $protocolo .= rand (0 , 9);

        $protocolo2 = $chars[rand (0 , 24)];
        $protocolo2 .= $chars[rand (0 , 24)];

        return "K".date("y").$protocolo.date("m").$protocolo2;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!(Gate::denies('read_produto'))){
            $produtos = Produto::paginate(40);  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.index");
            //--------------------------------------------------------------------------------------------

            return view('produto.index', array('produtos' => $produtos, 'buscar' => null));
        }
        else{
            return view('errors.403');
        }
    }

    public function busca (Request $request){
        if(!(Gate::denies('read_produto'))){
            $buscaInput = $request->input('busca');
            $produtos = Produto::where('titulo', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('palavras_chave', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('sku', 'LIKE', '%'.$buscaInput.'%')
                                ->orwhere('descricao', 'LIKE', '%'.$buscaInput.'%')
                                ->paginate(40);  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.busca=".$buscaInput);
            //--------------------------------------------------------------------------------------------

            return view('produto.index', array('produtos' => $produtos, 'buscar' => $buscaInput ));

        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {

        //
        if(!(Gate::denies('read_produto'))){

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.show=".$produto);
            //--------------------------------------------------------------------------------------------

            $imagens = $produto->imagens()->get();

            return view('produto.show', compact('produto', 'imagens'));
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(!(Gate::denies('read_produto'))){

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.create");
            //--------------------------------------------------------------------------------------------
        
            return view('produto.create');
        }
        else{
            return view('errors.403');
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(!(Gate::denies('read_produto'))){
            //Validação
            $this->validate($request,[
                    'titulo' => 'required|min:3',
                    'palavras_chave' => 'required|min:3',      
                    'descricao' => 'required|min:10',      
            ]);            
                    
            $produto = new Produto();
            $produto->sku = $this->skuGenerate();
            $produto->titulo = $request->input('titulo');
            $produto->palavras_chave = $request->input('palavras_chave');
            $produto->descricao = $request->input('descricao');
            $produto->status = "1"; //Produto Ativo

            //Cubagem
            $produto->altura = $request->input('altura');
            $produto->largura = $request->input('largura');
            $produto->comprimento = $request->input('comprimento');
            $produto->peso = $request->input('peso');

            $produto->link_referencia = $request->input('link_referencia');
            

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.store");
            //--------------------------------------------------------------------------------------------

            if($produto->save()){
                return redirect('produtos/')->with('success', 'Produto cadastrado com sucesso!');
            }else{
                return redirect('produtos/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
        if(!(Gate::denies('read_produto'))){
            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.edit.id=".$produto);
            //--------------------------------------------------------------------------------------------

            return view('produto.edit', compact('produto'));
        }
        else{
            return view('errors.403');
        }  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        //
        if(!(Gate::denies('read_produto'))){

            $this->validate($request,[
                    'titulo' => 'required|min:3',
                    'palavras_chave' => 'required|min:3',      
                    'descricao' => 'required|min:10',      
            ]);  

            // 1 - Ativo
            // 0 - Desativado
            $produto->status = $request->input('status');          
                    
            $produto->titulo = $request->input('titulo');
            $produto->palavras_chave = $request->input('palavras_chave');
            $produto->descricao = $request->input('descricao');

            //Cubagem
            $produto->altura = $request->input('altura');
            $produto->largura = $request->input('largura');
            $produto->comprimento = $request->input('comprimento');
            $produto->peso = $request->input('peso');

            $produto->link_referencia = $request->input('link_referencia');  

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.update=".$produto);
            //--------------------------------------------------------------------------------------------    

            if($produto->save()){
                return redirect('produtos/')->with('success', 'Produto atualizado com sucesso!');
            }else{
                return redirect('produtos/'.$id.'/edit')->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return view('errors.403');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        //
        if(!(Gate::denies('read_produto'))){
            $produto = Produto::find($id);        
            
            $produto->delete();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.destroy.id=".$id);
            //--------------------------------------------------------------------------------------------

            return redirect()->back()->with('success','Produto excluído com sucesso!');

        }
        else{
            return view('errors.403');
        }
    }

    public function imagem($id)
    {
        //
        if(!(Gate::denies('read_produto'))){ 

            $produto = Produto::find($id);

            $imagens = $produto->imagens()->get();

            $imagem_principal = Upload::where('id', $produto->upload_id)->first();


            //LOG ----------------------------------------------------------------------------------------
            $this->log("upload.imagem.produto");
            //--------------------------------------------------------------------------------------------

            return view('produto.imagem', compact('produto', 'imagem_principal', 'imagens'));
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    public function imagemUpdate(Request $request)
    {
        if(!(Gate::denies('update_produto'))){

            $id = $request->input('id');

            //Validação
            $this->validate($request,[
                    'file' => 'required|mimes:jpeg,png,jpg,pdf',
            ]);

            $dir = 'files/produtos/'.$id.'/galeria';


            /* -------------------------------- UPLOAD --------------------*/

            $file = $request->file('file');

            // Se informou o arquivo, retorna um boolean
            //$file = $request->hasFile('file');
             
            // Se é válido, retorna um boolean
            //$file = $request->file('file')->isValid();

            // Retorna mime type do arquivo (Exemplo image/png)
            $tipo = $request->file('file')->getMimeType();
             
            // Retorna o nome original do arquivo
            $nome = $request->file('file')->getClientOriginalName();
             
            // Extensão do arquivo
            //$request->file('file')->getClientOriginalExtension();
            $ext = $request->file('file')->extension();
             
            // Tamanho do arquivo
            $tam = $request->file('file')->getClientSize();

            // Define um aleatório para o arquivo baseado no timestamps atual
            $link = uniqid(date('HisYmd'));

            // Define finalmente o nome
            $link = "{$link}.{$ext}";

            // Faz o upload:
            $upload = $request->file->storeAs($dir, $link);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao


            /* -------------------------------- END UPLOAD --------------------*/

            //Pegar dados do Produto
            $produto = Produto::find($id);

                    
            $upload = new Upload();
            $upload->titulo = $produto->titulo;
            $upload->dir = $dir;
            $upload->link = $link;
            $upload->tipo = $tipo;
            $upload->nome = $nome;
            $upload->ext = $ext;
            $upload->tam = $tam;

            
            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.imagem.store=".$request);
            //--------------------------------------------------------------------------------------------

            if($upload->save()){

                /* ------------Vinculo do Arquivo------------- */

                $upload_id = DB::getPdo()->lastInsertId();
                
                $status = Produto::find($id)->imagens()->attach($upload_id);                               

                /* ------------END Vinculo do Arquivo------------- */

                return redirect('produtos/'.$id.'/imagem')->with('success', 'Imagem Alterada com Sucesso!.');
            }else{
                return redirect('produtos/'.$id.'/imagem')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    public function imagemDestroy(Request $request, $id)
    {
        
        //
        if(!(Gate::denies('delete_upload'))){
            $upload = Upload::find($id);  

            $file = $upload->dir.'/'.$upload->link;    

            //Apagar arquivo físico

            if(Storage::delete($file)){

                if($upload->delete()){
                    $status = true;
                }else{
                    $status = false;
                }

            }else{
               $status = false; 
            } 


            //LOG ----------------------------------------------------------------------------------------
            $this->log("upload.imagem.produto.destroy.id=".$upload);
            //--------------------------------------------------------------------------------------------

            $produto_id = $request->input('produto_id');

            if($status){
                return redirect('produtos/'.$produto_id.'/imagem')->with('success', 'Imagem Excluida com Sucesso!.');
            }else{
                return redirect('produtos/'.$produto_id.'/imagem')->with('danger', 'Houve um problema, tente novamente.');
            }

        }
        else{
            return redirect('erro')->with('permission_error', '403');
        }
    }

    public function imagemPrincipal($imagem_id, $produto_id)
    {
        
        

        if(!(Gate::denies('update_produto'))){

            $produto = Produto::find($produto_id);

            $produto->upload_id = $imagem_id;

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.imagem.principal.Update.id=".$produto_id."Imagem".$imagem_id);
            //--------------------------------------------------------------------------------------------
            
            if($produto->save()){
                return redirect('produtos/'.$produto_id.'/imagem')->with('success', 'Imagem atualizada com sucesso!');
            }else{
                return redirect('produtos/'.$produto_id.'/imagem')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }

    }


    public function categoria($id){
        if(!(Gate::denies('read_produto'))){
            //Recupera a permissão

            $produto = Produto::find($id);

            //recuperar permissões
            $categorias = $produto->categorias()->get();

            //todas permissoes
            $all_categorias = Categoria::all();

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.categoria.id=".$id);
            //--------------------------------------------------------------------------------------------

            return view('produto.categoria', compact('produto', 'categorias', 'all_categorias'));
        }
        else{
            return view('errors.403');
        }


    }

    public function categoriaUpdate(Request $request){

        if(!(Gate::denies('update_produto'))){

            $produto_id = $request->input('produto_id');
            $categoria_id_array = $request->input('categoria_id'); 

            $produto  = Produto::find($produto_id);

            foreach ($categoria_id_array as $categoria_id) {
                    $status = $produto->categorias()->attach($categoria_id);
            }            

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.categoriaUpdate.id=".$produto_id."Categoria".$categoria_id);
            //--------------------------------------------------------------------------------------------
            
            if(!$status){
                return redirect('produtos/'.$produto_id.'/categorias')->with('success', 'Categoria atualizada com sucesso!');
            }else{
                return redirect('produtos/'.$produto_id.'/categorias')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }

    }

    public function categoriaDestroy(Request $request){
        if(!(Gate::denies('delete_produto'))){

            /* -------------------- */

            $produto_id = $request->input('produto_id');
            $categoria_id = $request->input('categoria_id'); 

            $produto  = Produto::find($produto_id);

            $status = $produto->categorias()->detach($categoria_id);

            //LOG ----------------------------------------------------------------------------------------
            $this->log("produto.categoria.destroy.id=".$produto." Categoria".$categoria_id);
            //--------------------------------------------------------------------------------------------
            
            if($status){
                return redirect('produtos/'.$produto_id.'/categorias')->with('success', 'Categoria removida com sucesso!');
            }else{
                return redirect('produtos/'.$produto_id.'/categorias')->with('danger', 'Houve um problema, tente novamente.');
            }
        }
        else{
            return view('errors.403');
        }
    }
}
