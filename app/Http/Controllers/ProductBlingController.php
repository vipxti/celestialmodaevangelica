<?php

namespace App\Http\Controllers;

use App\BlingChannels;
use App\BlingStore;
use App\Category;
use App\Http\Requests\BlingStoreRequest;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductVariation;
use App\Sku;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductBlingController extends Controller{

    //======================================================================================================
    //RETORNA PÁGINA DA BUSCA PRODUTO BLING
    public function importFromBling(){
        return view('pages.admin.products.integration.bling.listProducts');
    }

    //======================================================================================================
    //RETORNA PÁGINA VINCULAR CATEGORIA
    public function vinculoCategorias(){

        $categorias = Category::all();

        $categoria_sistema = DB::table('integracao_sistema_cat_bling')->get();

        $arraySequencia = [];
        $arrayCategorias = [];
        $arrayCategoriasSistema = [];
        $arrayCategoriaPai = [];
        $arrayFkCategoria = [];
        $concatenador = "";

        foreach($categoria_sistema as $c){

            $categoria_pai = $c->fk_categoria_blig;
            $cat_subcat = $c->fk_categoria_subcat;

            array_push($arrayCategoriaPai, $categoria_pai);
            array_push($arrayFkCategoria, $cat_subcat);
            //dd($cat_subcat);
            do{

                $cat = DB::table('integracao_categoria_bling')->where('id_categoria', '=', $categoria_pai)->get();

                array_push($arraySequencia, $cat[0]->nome);
                $categoria_pai = $cat[0]->id_cat_pai;

            }while($categoria_pai != 0);

            for($i = (count($arraySequencia)-1); $i>=0; $i--){
                $concatenador .= $arraySequencia[$i];
                if($i!=0)
                    $concatenador .= " > ";
            }

            array_push($arrayCategorias, $concatenador);
            $arraySequencia = [];
            $concatenador = "";

            $cat_subcat = DB::table('categoria_subcat')
                        ->join('categoria', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                        ->join('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                        ->where('categoria_subcat.cd_categoria_subcat', '=', $cat_subcat)
                        ->get();
            //dd($cat_subcat);
            $nm_categoria = "";
            $nm_categoria = $cat_subcat[0]->nm_categoria . " > " . $cat_subcat[0]->nm_sub_categoria;
            array_push($arrayCategoriasSistema, $nm_categoria);
        }

        //dd($arrayCategorias);

        return view('pages.admin.products.integration.bling.categoryBond', compact('categorias', 'arrayCategorias', 'arrayCategoriasSistema', 'arrayCategoriaPai', 'arrayFkCategoria'));
    }

    //======================================================================================================
    //RETORNA PÁGINA CADASTRAR LOJAS
    public function indexCadLoja(){
        $lojas = BlingStore::all();
        return view('pages.admin.products.integration.bling.cadStore', compact('lojas'));
    }

    //======================================================================================================
    //RETORNA PÁGINA PUT -> ATUALIZAR PRODUTO
    public function indexAtualizarProd(){
        $lojas = BlingStore::all();
        $canais = BlingChannels::all();
        return view('pages.admin.products.integration.bling.atualizaProdBling', compact('lojas', 'canais'));
    }

    //======================================================================================================
    //PEGA OS DADOS CADASTRADOS DA EMPRESA
    public function CompanyData(){
        $dadoUsuario = DB::table('dados_empresa')->get();

        if(count($dadoUsuario) == 0){
            return response()->json([
                'message' => false
            ]);
        }

        return response()->json([
            'message' => true
        ]);
    }

    //======================================================================================================
    //BUSCA O PRODUTO POR CÓDIGO NA API DO BLING
    public function searchProdByName($code){
        $dadoUsuario = DB::table('dados_empresa')->get();

        $apikey = $dadoUsuario[0]->cd_api_key;
        $loja = $dadoUsuario[0]->cd_api_bling;

        $outputType = "json";
        $url = 'https://bling.com.br/Api/v2/produto/' . $code . '/' . $outputType . '&imagem=S&loja='. $loja .'&estoque=S';
        $retorno = $this->executeGetProduct($url, $apikey);

        return response()->json([$retorno]);
    }

    function executeGetProduct($url, $apikey){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }

    //======================================================================================================
    //BUSCA OS PRODUTOS POR PÁGINA NA API DO BLING
    public function searchProds($pagina){
        //$pagina = $_POST["pagina"];
        //$apikey = "2a51570170237bfda75036d304640a61ba9c4330bc33e3551e39e8454ea4f838ceb58337";
        //$loja = "203208658";

        $dadoUsuario = DB::table('dados_empresa')->get();

        $apikey = $dadoUsuario[0]->cd_api_key;
        $loja = $dadoUsuario[0]->cd_api_bling;

        $outputType = "json";
        $url = 'https://bling.com.br/Api/v2/produtos/' . $pagina . '/' . $outputType . '&imagem=S&loja='. $loja .'&estoque=S';
        $retorno = $this->executeGetProducts($url, $apikey);
        //echo $retorno;
        return response()->json([$retorno]);
    }

    public function executeGetProducts($url, $apikey){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }

    //======================================================================================================
    //BUSCA AS CATEGORIAS NA API DO BLING
    public function getCategories(){
        //$apikey = "2a51570170237bfda75036d304640a61ba9c4330bc33e3551e39e8454ea4f838ceb58337";

        $dadoUsuario = DB::table('dados_empresa')->get();

        $apikey = $dadoUsuario[0]->cd_api_key;

        $outputType = "json";
        $url = 'https://bling.com.br/Api/v2/categorias/' . $outputType;

        $retorno = $this->executeGetCategories($url, $apikey);
        //echo $retorno;
        return response()->json([$retorno]);
    }

    public function executeGetCategories($url, $apikey){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }

    //======================================================================================================
    //BUSCA AS CATEGORIAS DA LOJA NA API DO BLING
    public function getStoreCategories(){

        $dadoUsuario = DB::table('dados_empresa')->get();

        $apikey = $dadoUsuario[0]->cd_api_key;
        $idLoja = $dadoUsuario[0]->cd_api_bling;
        //$apikey = "2a51570170237bfda75036d304640a61ba9c4330bc33e3551e39e8454ea4f838ceb58337";
        //$idLoja = "203208658";
        $outputType = "json";
        //$url = 'https://bling.com.br/Api/v2/categoriasLoja/' . $outputType;
        $url = 'https://bling.com.br/Api/v2/categoriasLoja/' . $idLoja . '/' . $outputType;
        $retorno = $this->executeGetStoreCategories($url, $apikey);
        //echo $retorno;
        return response()->json([$retorno]);
    }

    public function executeGetStoreCategories($url, $apikey){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }

    public function saveAllProducts(ProductRequest $request){

    }

    public function saveAllCategories(Request $request){

    }

    //======================================================================================================
    //FUNÇÃO CHAMADA PARA FAZER A LIGAÇÃO DAS CATEGORIAS SIST -> BLING
    public function integracaoSistCatBling(Request $request){
        //dd($request->all());

        $itensId = $request->itensId;
        $itensNome = $request->itensNome;
        $fk_cat_bling = '';
        //dd($itensId, $itensNome);

        for($i = 0; $i< count($itensId); $i++){
            if($i == 0)
                $this->saveBlingCategory($itensId[$i], $itensNome[$i], 0, ($i + 1));
            else
                $this->saveBlingCategory($itensId[$i], $itensNome[$i], $itensId[($i - 1)], ($i + 1));
        }

        $this->saveBondBlingSist($itensId[(count($itensId) - 1)], $request->idCatSist, $request->idSubCatSist);
    }

    //======================================================================================================
    //SALVA AS CATEGORIAS DO BLING NO BANCO
    public function saveBlingCategory($id, $nomeCat, $idPai, $hierarquia){
        //dd($id, $nomeCat, $idPai, $hierarquia);
        $categoria = DB::table('integracao_categoria_bling')->where('id_categoria', '=', $id)->get();

        //dd($categoria);

        if(count($categoria) == 0) {
            DB::table('integracao_categoria_bling')
                ->insert(['id_categoria' => $id,
                    'nome' => $nomeCat,
                    'id_cat_pai' => $idPai,
                    'hierarquia' => $hierarquia]);
        }
    }

    //======================================================================================================
    //CRIA A ASSOCIAÇÃO DAS CATEGORIAS DO SIST COM AS DO BLING
    public function saveBondBlingSist($fk_cat_bling, $idCat, $idSubCat){
        //dd($fk_cat_bling, $idCat, $idSubCat);

        $cat_subcat = DB::table('categoria_subcat')
                        ->where('cd_categoria', '=', $idCat)
                        ->where('cd_sub_categoria', '=', $idSubCat)
                        ->get();

        //dd($cat_subcat[0]->cd_categoria_subcat);

        DB::table('integracao_sistema_cat_bling')
                    ->insert(['fk_categoria_subcat'=> $cat_subcat[0]->cd_categoria_subcat,
                            'fk_categoria_blig'=>$fk_cat_bling]);
    }

    //======================================================================================================
    //ATUALIZA ASSOCIAÇÃO
    public function updateBondBlingSist(Request $request){
        //dd($request->all());

        $cat_subcat_novo = DB::table('categoria_subcat')
            ->where('cd_categoria', '=', $request->idCatSist)
            ->where('cd_sub_categoria', '=', $request->idSubCatSist)
            ->get();
        //dd($cat_subcat);

        $itensId = $request->itensId;
        $fk_cat_bling = $itensId[(count($itensId) - 1)];

        $cat_subcat_antigo = DB::table('integracao_categoria_bling')
            ->join('integracao_sistema_cat_bling', 'integracao_categoria_bling.id_categoria', '=', 'integracao_sistema_cat_bling.fk_categoria_blig')
            ->join('categoria_subcat', 'integracao_sistema_cat_bling.fk_categoria_subcat', '=', 'categoria_subcat.cd_categoria_subcat')
            ->where('integracao_categoria_bling.id_categoria', '=', $fk_cat_bling)
            ->get();

        //dd($cat_subcat_antigo[0]->cd_categoria_subcat);

        //dd($fk_cat_bling);
        DB::table('integracao_sistema_cat_bling')
            ->where('fk_categoria_subcat', '=', $cat_subcat_antigo[0]->cd_categoria_subcat)
            ->where('fk_categoria_blig', '=', $fk_cat_bling)
            ->update(['fk_categoria_subcat'=> $cat_subcat_novo[0]->cd_categoria_subcat]);

    }

    //======================================================================================================
    //DELETA ASSOCIAÇÃO
    public function deleteBondBlingSist(Request $request){
        //dd($request->all());

        try{
            DB::table('integracao_sistema_cat_bling')
                ->where('integracao_sistema_cat_bling.fk_categoria_subcat', '=', $request->id_sist)
                ->where('integracao_sistema_cat_bling.fk_categoria_blig', '=', $request->id_bling)
                ->delete();
        }
        catch (\Exception $ex){
            return response()->json(['deuErro' => true]);
        }

        return response()->json(['deuErro' => false]);
    }

    //======================================================================================================
    //VERIFICA SE EXISTE UMA CATEGORIA DO BLING CADASTRADA
    public function verifyBlingCategory(Request $request){
        //dd($request->all());

        $cat_bling = DB::table('integracao_sistema_cat_bling')
                    ->where('fk_categoria_blig', '=', $request->idCatBling)
                    ->get();

        /*$cat_subcat = DB::table('categoria_subcat')
            ->where('cd_categoria', '=', $request->idCat)
            ->where('cd_sub_categoria', '=', $request->idSubCat)
            ->get();


        $cat_bling =DB::table('integracao_sistema_cat_bling')
                ->where('fk_categoria_subcat', '=', $cat_subcat[0]->cd_categoria_subcat)
                ->get();*/

        //dd($cat_bling);


        if(count($cat_bling) > 0)
            return response()->json(['jaExiste'=>true]);
        else
            return response()->json(['jaExiste'=>false]);
    }

    //======================================================================================================
    //CONSULTA AS CATEGORIAS ASSOCIADAS DO SIST->BLING
    public function consultCategoriesBlingSist(Request $request){
        //dd($request->all());
        $array_categorias = [];
        $categoria_pai = $request->categoria;
        $categoria = DB::table('integracao_categoria_bling')
            ->join('integracao_sistema_cat_bling', 'integracao_categoria_bling.id_categoria', '=', 'integracao_sistema_cat_bling.fk_categoria_blig')
            ->join('categoria_subcat', 'integracao_sistema_cat_bling.fk_categoria_subcat', '=', 'categoria_subcat.cd_categoria_subcat')
            ->join('categoria', 'categoria_subcat.cd_categoria', '=', 'categoria.cd_categoria')
            ->join('sub_categoria', 'categoria_subcat.cd_sub_categoria', '=', 'sub_categoria.cd_sub_categoria')
            //->where('integracao_categoria_bling.id_categoria', '=', $categoria_pai)
            ->get();

        //dd($categoria);

        try {
            do {

                $categoria_integracao = DB::table('integracao_categoria_bling')
                    ->where('integracao_categoria_bling.id_categoria', '=', $categoria_pai)
                    ->get();

                array_push($array_categorias, $categoria_integracao);

                $categoria_pai = $categoria_integracao[0]->id_cat_pai;

            } while ($categoria_pai != 0);
        }
        catch (\Exception $ex){

        }

        //dd($array_categorias);

        return response()->json(['categoria_sistema' => $categoria, 'categoria_bling' => $array_categorias]);
    }

    //======================================================================================================
    //SALVA LOJAS DO BLING
    public function saveBlingStores(BlingStoreRequest $request){
        //dd($request->all());
        try{
            $loja = new BlingStore;
            $loja->id_loja = $request->id_loja;
            $loja->nome_loja = $request->nome_loja;
            $loja->save();
        }
        catch (\Exception $ex){
            DB::rollBack();
            return redirect()->route('index.store.bling')->with('nosuccess', 'Erro ao criar loja!');
        }

        return redirect()->route('index.store.bling')->with('success', 'Loja criada com sucesso!');
    }

    //======================================================================================================
    //RETORNA VIEW PARA EDITAR LOJAS
    public function indexEditStore($id){
        //dd($id);
        $loja = BlingStore::find($id);

        return view('pages.admin.products.integration.bling.editStore', compact('loja'));
    }

    //======================================================================================================
    //ALTERA AS LOJAS
    public function editBlingStores(BlingStoreRequest $request){
        //dd($request->all());

        try{
            $loja = BlingStore::find($request->id_loja);
            $loja->id_loja = $request->id_loja;
            $loja->nome_loja = $request->nome_loja;
            $loja->save();
        }
        catch (\Exception $ex){
            DB::rollBack();
            return redirect()->route('index.store.bling')->with('nosuccess', 'Erro ao alterar loja!');
        }

        return redirect()->route('index.store.bling')->with('success', 'Loja alterada com sucesso!');
    }

    //======================================================================================================
    //DELETA AS LOJAS
    public function deleteBlingStores($id){
        //dd($id);
        try{
            $loja = BlingStore::find($id);
            $loja->delete();
        }
        catch (\Exception $ex){
            DB::rollBack();
            return response()->json(['deuErro' => true]);
        }

        return response()->json(['deuErro' => false]);
    }

    //======================================================================================================
    //BUSCA PRODUTOS DA LOJA PARA ALTERAR PREÇOS
    public function searchProdsByStore($pagina, $loja){
        //dd($id, $loja);
        $dadoUsuario = DB::table('dados_empresa')->get();
        $apikey = $dadoUsuario[0]->cd_api_key;

        $outputType = "json";
        $url = 'https://bling.com.br/Api/v2/produtos/' . $pagina . '/' . $outputType . '&loja='. $loja;
        $retorno = $this->executeGetProducts($url, $apikey);

        return response()->json([$retorno]);
    }

    //======================================================================================================
    //BUSCA PRODUTOS DA LOJA PARA ALTERAR PREÇOS
    public function searchProdsByStoreByName($code, $loja){
        //dd($id, $loja);
        $dadoUsuario = DB::table('dados_empresa')->get();
        $apikey = $dadoUsuario[0]->cd_api_key;

        $outputType = "json";
        $url = 'https://bling.com.br/Api/v2/produto/' . $code . '/' . $outputType . '&imagem=S&loja='. $loja .'&estoque=S';
        $retorno = $this->executeGetProduct($url, $apikey);

        return response()->json([$retorno]);
    }

    //======================================================================================================
    //ATUALIZA O PREÇO DOS PRODUTOS NO BLING
    public function alterPriceProducts(Request $request){
        //dd($request->all());
        $dadoUsuario = DB::table('dados_empresa')->get();
        $apikey = $dadoUsuario[0]->cd_api_key;

        $url = 'https://bling.com.br/Api/v2/produtoLoja/'. $request->loja . '/'. $request->sku;
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' .
                    '<produtosLoja>' .
                            '<produtoLoja>' .
                                    '<idLojaVirtual>'. $request->id_loja .'</idLojaVirtual>' .
                                    '<preco>' .
                                            '<preco>'. $request->preco .'</preco>' .
                                            '<precoPromocional>'. $request->preco .'</precoPromocional>' .
                                    '</preco>' .
                            '</produtoLoja>' .
                    '</produtosLoja>';

        //$xmlObj = new \SimpleXMLElement($xml);
        //header('Content-Type: application/xml');
        /*$xml = new \SimpleXMLElement('<xml/>');

        $pedido = $xml->addChild('produtosLoja');
        $produto = $pedido->addChild('produtoLoja');
        $produto->addChild('idLojaVirtual', $request->loja);
        $preco = $produto->addChild('preco');
        $preco->addChild('precim', $request->preco);*/

        //dd($xmlObj->asXML());


        $posts = array (
            "apikey" => $apikey,
            "xml" => rawurlencode($xml)
        );
        //dd($posts);

        $retorno = $this->executeUpdateProductStore($url, $posts);
        //echo $retorno;
        return response()->json([$retorno]);
    }

    public function executeUpdateProductStore($url, $data){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }

    //======================================================================================================
    //URL CALLBACK CONTROLE ESTOQUE BLING
    public function controleEstoque(Request $request){

        $estoque = json_decode($request->data, true);

        $produto = \App\Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
            ->where('sku.cd_nr_sku', '=', $estoque['retorno']['estoques'][0]['estoque']['codigo'])
            ->get();

        if(count($produto) > 0){
            \App\Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
                ->where('sku.cd_nr_sku', '=', $estoque['retorno']['estoques'][0]['estoque']['codigo'])
                ->update(['qt_produto' => $estoque['retorno']['estoques'][0]['estoque']['estoqueAtual']]);
        }
        else{
            $produtoVariacao = \App\ProductVariation::join('sku', 'produto_variacao.cd_sku', '=', 'sku.cd_sku')
                ->where('sku.cd_nr_sku', '=', $estoque['retorno']['estoques'][0]['estoque']['codigo'])
                ->get();

            if(count($produtoVariacao) > 0){
                \App\ProductVariation::join('sku', 'produto_variacao.cd_sku', '=', 'sku.cd_sku')
                    ->where('sku.cd_nr_sku', '=', $estoque['retorno']['estoques'][0]['estoque']['codigo'])
                    ->update(['qt_produto_variacao' => $estoque['retorno']['estoques'][0]['estoque']['estoqueAtual']]);
            }
        }
    }

}


