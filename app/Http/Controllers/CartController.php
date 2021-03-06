<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Category;
use App\NavigationMenu;
use Cagartner\CorreiosConsulta\CorreiosConsulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Client as Cli;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function showCartPage()
    {
        if (Session::has('cartRoute')) {
            Session::forget('cartRoute');
        }

        if (Auth::check()) {
            $cep = Cli::join('cliente_endereco', 'cliente.cd_cliente', 'cliente_endereco.cd_cliente')->join('endereco', 'endereco.cd_endereco', 'cliente_endereco.cd_endereco')->select('endereco.cd_cep', 'cliente_endereco.ic_principal', 'cliente_endereco.nm_destinatario', 'endereco.ds_endereco', 'cliente_endereco.cd_numero_endereco')->where('cliente.cd_cliente', '=', Auth::user()->cd_cliente)->get()->toArray();
        } else {
            $cep = null;
        }

        if ($cep == null) {
            $this->clearShippingData();
        }

        $menuNav =  Menu::all();

        $menuNavegacao = NavigationMenu::all();
        //dd($menuNavegacao[0]->menu_ativo);
        if (count($menuNavegacao) > 0) {
            if ($menuNavegacao[0]->menu_ativo == 1) {
                //Carrega as categorias e subcategorias para serem apresentadas no menu nav
                foreach ($menuNav as $key => $menu) {
                    $categoriaSubCat[$key] = Category::
                    leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                        ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                        ->leftJoin('menu_categoria', 'menu_categoria.fk_cd_categoria', '=', 'categoria.cd_categoria')
                        ->leftJoin('menu', 'menu.cd_menu', '=', 'menu_categoria.fk_cd_menu')
                        ->select(
                            'categoria.cd_categoria',
                            'categoria.nm_categoria',
                            'sub_categoria.cd_sub_categoria',
                            'sub_categoria.nm_sub_categoria'
                        )
                        ->where('menu.cd_menu', '=', $menu->cd_menu)
                        ->get();
                }
            } else {
                $categoriaSubCat = Category::leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                    ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                    ->join('ordem_categoria', 'ordem_categoria.fk_cd_categoria', '=', 'categoria.cd_categoria')
                    ->select(
                        'categoria.cd_categoria',
                        'categoria.nm_categoria',
                        'sub_categoria.cd_sub_categoria',
                        'sub_categoria.nm_sub_categoria'
                    )
                    ->orderBy('ordem_categoria.cd_ordem_categoria')
                    ->get();
            }
        }

        return view('pages.app.cart.index', compact('cep', 'menuNav', 'categoriaSubCat', 'menuNavegacao'));
    }

    public function setCartData(){
        if(!Session::has('cartRoute')){
            Session(['cartRoute' => 'cart.page']);
            Session::save();
        }

    }

    public function calculateShipping(Request $request)
    {
        //dd($request->all());
        
        if (Session::has('shippingOptions')) {
            Session::forget('shippingOptions');
        }

        Session::put('shippingOptions', []);

        if (Session::has('cepPrincipal')) {
            Session::forget('cepPrincipal');
        }

        Session::push('cepPrincipal', $request->cep);

        $pesoCubico = ($request->length * $request->height * $request->width) / 6000;
        $peso = $request->quantity * 0.3;

        $cidade = DB::table('ceps_baixada_santista')
            ->where('cep_inicial', '<', $request->cep)
            ->where('cep_final', '>', $request->cep)
            ->get();

        $valor = 0;
        $prazo = 0;
        if(count($cidade) > 0){
            $valor = $cidade[0]->vl_frete;
            $prazo = 48;
        }

        //dd($cidade);
        //dd($pesoCubico);
        //dd($peso);

        $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?';
        $url .= '&nCdEmpresa=';
        $url .= '&sDsSenha=';
        $url .= '&nCdServico=04510,04014'; //04510 - PAC / 04014 - Sedex
        $url .= '&sCepOrigem=11310060';
        $url .= '&sCepDestino=' . $request->cep;
        $url .= '&nVlPeso='.$peso;// . $request->weight;
        $url .= '&nCdFormato=1';
        $url .= '&nVlComprimento=30';// . $request->length;
        $url .= '&nVlAltura=15';// . $request->height;
        $url .= '&nVlLargura=15';// . $request->width;
        $url .= '&nVlDiametro=0';
        $url .= '&sCdMaoPropria=n';
        $url .= '&nVlValorDeclarado=0';// . $request->price;
        $url .= '&sCdAvisoRecebimento=n';
        $url .= '&StrRetorno=xml';

        //dd($url);
        
        $xml = simplexml_load_file($url);

        //dd($xml);

        $fretes['pac'] = [
            'valor' => $xml->cServico[0]->Valor,
            'prazo' => (int) $xml->cServico[0]->PrazoEntrega,
            'obs' => strval($xml->cServico[0]->obsFim)
        ];

        $fretes['sedex'] = [
            'valor' => $xml->cServico[1]->Valor,
            'prazo' => (int) $xml->cServico[1]->PrazoEntrega,
            'obs' => strval($xml->cServico[1]->obsFim)
        ];

        $fretes['maktub'] = [
            'valor' => $valor,
            'prazo' => $prazo
        ];

        $f = [
            'valorPac' => strval($xml->cServico[0]->Valor),
            'prazoPac' => ((int) $xml->cServico[0]->PrazoEntrega) + 3,
            'valorSedex' => strval($xml->cServico[1]->Valor),
            'prazoSedex' => ((int) $xml->cServico[1]->PrazoEntrega) + 3,
            'valorMaktub' => $valor,
            'prazoMaktub' => $prazo
        ];

        Session::push('shippingOptions', $f);

        Session::save();

        $response = $fretes;

        return response()->json([ 'fretes' => $fretes ]);
    }

    public function calcFrete($cep, $altura, $largura, $peso, $comprimento)
    {
        if ($largura < 11) {
            $largura = 11;
        }
        if ($altura < 2) {
            $altura = 2;
        }
        if ($comprimento < 16) {
            $comprimento = 16;
        }

        $dados = [
            'tipo'              => 'pac,sedex', // Separar opções por vírgula (,) caso queira consultar mais de um (1) serviço. > Opções: `sedex`, `sedex_a_cobrar`, `sedex_10`, `sedex_hoje`, `pac`, 'pac_contrato', 'sedex_contrato' , 'esedex'
            'formato'           => 'caixa', // opções: `caixa`, `rolo`, `envelope`
            'cep_destino'       => $cep, // Obrigatório
            'cep_origem'        => '11310060', // Obrigatorio
            //'empresa'         => '', // Código da empresa junto aos correios, não obrigatório.
            //'senha'           => '', // Senha da empresa junto aos correios, não obrigatório.
            'peso'              => $peso, // Peso em kilos
            'comprimento'       => $comprimento, // Em centímetros
            'altura'            => $altura, // Em centímetros
            'largura'           => $largura, // Em centímetros
            'diametro'          => '0', // Em centímetros, no caso de rolo
            // 'mao_propria'       => '1', // Não obrigatórios
            // 'valor_declarado'   => '1', // Não obrigatórios
            // 'aviso_recebimento' => '1', // Não obrigatórios
        ];

        $c = new CorreiosConsulta();

        $frete = $c->frete($dados);

        /*$dados = [
            0 => $altura,
            1 => $largura,
            2 => $peso,
            3 => $comprimento,
        ];*/

        return response()->json([ 'freteCalculado' => $frete ]);
    }

    public function getShippingData(Request $request)
    {
        $subTotal = Session::get('subtotalPrice');

        if (Session::has('shippingData')) {
            Session::forget('shippingData');
        }

        $total = $subTotal + $request->shippingPrice;

        Session::put('shippingData', []);

        $shippingData = [
            'tipo' => $request->shippingType,
            'valor' => $request->shippingPrice,
            'precoTotal' => strval($total)
        ];

        Session::push('shippingData', $shippingData);

        session([ 'totalPrice' => $total ]);

        Session::save();

        $response = $shippingData;

        return response()->json([ 'shippingData' => $response ]);
    }

    public function calcFreteOffline($cep, $peso)
    {
        //$e = DB::select('CALL buscarFrete('.$cep.','.$peso.')');
        $frete = DB::select('CALL buscarFrete(:Cep,:Peso)', [
            ':Cep' => $cep,
            ':Peso' => $peso,
        ]);

        return response()->json([ 'freteCalculado' => $frete ]);
    }

    public function addToCart(Request $request)
    {
        //dd($request->all());
        //dd($this->verificaProduto($request->sku_produto));

        //Verificar se já tem produto no carrinho
        //Se tem, acrescentar a quantidade
        //Se não tem, salvar na session o primeiro produto
        
        //verificar se o produto acrescentado é diferente
        //Se for, fazer a lógica de acrecentar na tabela do carrinho

        if ($this->checkIfProductExistsInCart($request->sku_produto)) {
            $produtosCarrinho = Session::get('cart');

            $qtdProdutosCarrinho = intval(Session::get('qtCart'));

            foreach ($produtosCarrinho as $key => $p) {
                if (in_array($request->sku_produto, $p)) {
                    $produto = $p;
                    $index = $key;
                }
            }

            $alturaTotal = Session::get('totalHeight');
            $larguraTotal = Session::get('totalWidth');
            $comprimentoTotal = Session::get('totalLength');
            $pesoTotal = Session::get('totalWeight');

            $alturaTotalIndividual = $produto['alturaTotalProduto'];
            $larguraTotalIndividual = $produto['larguraTotalProduto'];
            $comprimentoTotalIndividual = $produto['comprimentoTotalProduto'];
            $pesoTotalIndividual = $produto['pesoTotalProduto'];

            $precoSubTotal = Session::get('subtotalPrice');
            $precoTotal = Session::get('totalPrice');

            $alturaTotal += $produto['alturaProduto'];
            $larguraTotal += $produto['larguraProduto'];
            $comprimentoTotal += $produto['comprimentoProduto'];
            $pesoTotal += $produto['pesoProduto'];

            $alturaTotalIndividual += $produto['alturaProduto'];
            $larguraTotalIndividual += $produto['larguraProduto'];
            $comprimentoTotalIndividual += $produto['comprimentoProduto'];
            $pesoTotalIndividual += $produto['pesoProduto'];
            
            $qtdIndividual = intval($produto['qtdIndividual']);

            if ($request->has('qt_produto_detalhes')) {
                $qtdIndividual += intval($request->qt_produto_detalhes);
                $val = doubleval($produto['valorProduto']) * intval($request->qt_produto_detalhes);
                $qtdProdutosCarrinho += intval($request->qt_produto_detalhes);
            } else {
                $qtdIndividual++;
                $val = doubleval($produto['valorProduto']);
                $qtdProdutosCarrinho += 1;
            }

            $valorTotalProduto = doubleval($produto['valorProduto']) * $qtdIndividual;

            $precoTotal += $val;
            $precoSubTotal += $val;

            $produto['qtdIndividual'] = intval($qtdIndividual);
            $produto['valorTotalProduto'] = doubleval($valorTotalProduto);

            $produto['alturaTotalProduto'] = doubleval($alturaTotalIndividual);
            $produto['larguraTotalProduto'] = doubleval($larguraTotalIndividual);
            $produto['comprimentoTotalProduto'] = doubleval($comprimentoTotalIndividual);
            $produto['pesoTotalProduto'] = doubleval($pesoTotalIndividual);

            $produtosCarrinho[$index] = $produto;

            session([ 'totalHeight' => $alturaTotal ]);
            session([ 'totalWidth' => $larguraTotal ]);
            session([ 'totalLength' => $comprimentoTotal ]);
            session([ 'totalWeight' => $pesoTotal ]);

            session([ 'subtotalPrice' => $precoSubTotal ]);
            session([ 'totalPrice' => $precoTotal ]);

            session([ 'qtCart' => $qtdProdutosCarrinho ]);
            session([ 'cart' => $produtosCarrinho ]);

            Session::save();

        //dd(Session::get('cart'));
        } else {
            if (Session::get('qtCart') == 0) {
                Session::put('cart', []);

                $qtdProdutosCarrinho = Session::get('qtCart');
                
                $qtdItensCarrinho = 1;

                if ($request->has('qt_produto_detalhes')) {
                    $qtdIndividual = $request->qt_produto_detalhes;
                    $qtdProdutosCarrinho += $qtdIndividual;
                } else {
                    $qtdIndividual = 1;
                    $qtdProdutosCarrinho++;
                }

                $valorTotalProduto = doubleval($request->vl_produto) * $qtdIndividual;

                $alturaTotal = 0;
                $larguraTotal = 0;
                $comprimentoTotal = 0;
                $pesoTotal = 0;

                $precoSubTotal = 0;
                $precoTotal = 0;

                $produtosCarrinho = [
                    'codProduto' => intval($request->cd_produto),
                    'nomeProduto' => $request->nm_produto,
                    'skuProduto' => $request->sku_produto,
                    'descricaoProduto' => $request->ds_produto,
                    'valorProduto' => doubleval($request->vl_produto),
                    'slugProduto' => $request->slug_produto,
                    'qtdProdutoEstoque' => intval($request->qt_produto),
                    'qtdIndividual' => intval($qtdIndividual),
                    'imagemProduto' => $request->im_produto,
                    'pesoProduto' => doubleval($request->ds_peso),
                    'pesoTotalProduto' => doubleval($request->ds_peso),
                    'alturaProduto' => doubleval($request->ds_altura),
                    'alturaTotalProduto' => doubleval($request->ds_altura),
                    'larguraProduto' => doubleval($request->ds_largura),
                    'larguraTotalProduto' => doubleval($request->ds_largura),
                    'comprimentoProduto' => doubleval($request->ds_comprimento),
                    'comprimentoTotalProduto' => doubleval($request->ds_comprimento),
                    'valorTotalProduto' => $valorTotalProduto
                ];

                Session::push('cart', $produtosCarrinho);

                $precoSubTotal = $valorTotalProduto;
                $alturaTotal += $request->ds_altura;
                $larguraTotal += $request->ds_largura;
                $comprimentoTotal += $request->ds_comprimento;
                $pesoTotal += $request->ds_peso;
                $precoTotal = $valorTotalProduto;

                Session::put('totalHeight', $alturaTotal);
                Session::put('totalWidth', $larguraTotal);
                Session::put('totalLength', $comprimentoTotal);
                Session::put('totalWeight', $pesoTotal);

                Session::put('subtotalPrice', $precoSubTotal);
                Session::put('totalPrice', $precoTotal);
                
                //Session::put('idx' . $request->sku_produto, $index);
                Session::put('qtCartItems', $qtdItensCarrinho);

                Session::put('qtCart', $qtdProdutosCarrinho);

                Session::save();
            } else {
                $qtdProdutosCarrinho = intval(Session::get('qtCart'));

                $qtdItensCarrinho = intval(Session::get('qtCartItems'));

                if ($request->has('qt_produto_detalhes')) {
                    $qtdIndividual = intval($request->qt_produto_detalhes);
                } else {
                    $qtdIndividual = 1;
                }

                $valorTotalProduto = doubleval($request->vl_produto) * $qtdIndividual;
                $qtdProdutosCarrinho += $qtdIndividual;
                
                $alturaTotal = Session::get('totalHeight');
                $larguraTotal = Session::get('totalWidth');
                $comprimentoTotal = Session::get('totalLength');
                $pesoTotal = Session::get('totalWeight');

                $precoSubTotal = Session::get('subtotalPrice');
                $precoTotal = Session::get('totalPrice');

                $produtosCarrinho = [
                    'codProduto' => $request->cd_produto,
                    'nomeProduto' => $request->nm_produto,
                    'skuProduto' => $request->sku_produto,
                    'descricaoProduto' => $request->ds_produto,
                    'valorProduto' => $request->vl_produto,
                    'slugProduto' => $request->slug_produto,
                    'qtdProdutoEstoque' => $request->qt_produto,
                    'qtdIndividual' => $qtdIndividual,
                    'imagemProduto' => $request->im_produto,
                    'pesoProduto' => $request->ds_peso,
                    'pesoTotalProduto' => $request->ds_peso,
                    'alturaProduto' => $request->ds_altura,
                    'alturaTotalProduto' => $request->ds_altura,
                    'larguraProduto' => $request->ds_largura,
                    'larguraTotalProduto' => $request->ds_largura,
                    'comprimentoProduto' => $request->ds_comprimento,
                    'comprimentoTotalProduto' => $request->ds_comprimento,
                    'valorTotalProduto' => $valorTotalProduto
                ];

                Session::push('cart', $produtosCarrinho);

                $precoSubTotal += $valorTotalProduto;
                $precoTotal += $valorTotalProduto;
                
                $alturaTotal += $request->ds_altura;
                $larguraTotal += $request->ds_largura;
                $comprimentoTotal += $request->ds_comprimento;
                $pesoTotal += $request->ds_peso;

                $qtdItensCarrinho++;

                session([ 'totalHeight' => $alturaTotal ]);
                session([ 'totalWidth' => $larguraTotal ]);
                session([ 'totalLength' => $comprimentoTotal ]);
                session([ 'totalWeight' => $pesoTotal ]);

                session([ 'subtotalPrice' => $precoSubTotal ]);
                session([ 'totalPrice' => $precoTotal ]);

                session([ 'qtCart' => $qtdProdutosCarrinho ]);
                session([ 'qtCartItems' => $qtdItensCarrinho ]);

                Session::save();
            }
        }

        return redirect()->route('cart.page')->with('success', 'Item adicionado ao carrinho');
    }

    public function checkIfProductExistsInCart($skuProduto)
    {
        if (Session::has('cart')) {
            $carrinho = Session::get('cart');

            foreach ($carrinho as $key => $item) {
                if ($item['skuProduto'] == $skuProduto) {
                    return true;
                }
            }
        }

        return false;
    }

    public function finalizarCompra(Request $request)
    {
        if ($request->telefone == null) {
            $ddd = null;
            $telefone = null;
        } else {
            $ddd = substr($request->telefone, 0, 2);
            $telefone = substr($request->telefone, 2);
        }

        if ($request->complemento_endereco == null) {
            $complemento = '';
        } else {
            $complemento = $request->complemento_endereco;
        }

        $data['token'] = '4D97A178277542CAAB150D1096002DF1';
        $data['email'] = 'vendas@vipx.com.br';
        $data['currency'] = 'BRL';

        foreach ($request->largura as $key => $l) {
            if ($l < 11) {
                $larguras[$key] = '11';
            } else {
                $larguras[$key] = $l;
            }
        }

        foreach ($request->altura as $key => $a) {
            if ($a < 2) {
                $alturas[$key] = '2';
            } else {
                $alturas[$key] = $a;
            }
        }

        foreach ($request->comprimento as $key => $c) {
            if ($c < 16) {
                $comprimentos[$key] = '16';
            } else {
                $comprimentos[$key] = $c;
            }
        }

        foreach ($request->peso as $key => $p) {
            $pesos[$key] = $p;
        }

        // foreach ($alt as $key => $a) {
        //     //dd($a);

        //     if (doubleval($a) < 2) {
        //         $alturas[$key] = 2;
        //     } else {
        //         $alturas[$key] = doubleval($a) * $qtd;
        //     }
        // }

        //dd($alturas);

        // foreach ($comp as $key => $c) {
        //     if ($c < 16) {
        //         $comprimentos[$key] = 16;
        //     } else {
        //         $comprimentos[$key] = doubleval($c) * $qtd;
        //     }
        // }
        
        // dd($comprimentos);

        // foreach ($pes as $key => $p) {
        //     $pesos[$key] = doubleval($p) * $qtd;
        // }

        foreach ($request->id as $key => $id) {
            $data['itemId'.($key + 1)] = $id;
        }

        foreach ($request->quantidade as $key => $qtd) {
            $data['itemQuantity'.($key + 1)] = $qtd;
        }

        foreach ($request->descricao as $key => $desc) {
            $data['itemDescription'.($key + 1)] = $desc;
        }
        
        foreach ($request->valor as $key => $val) {
            $data['itemAmount'.($key + 1)] = $val;
        }

        foreach ($pesos as $key => $p) {
            $data['itemWeight'.($key + 1)] = intval($p);
        }
        
        foreach ($larguras as $key => $l) {
            $data['itemWidth'.($key + 1)] = $l;
        }
        
        foreach ($alturas as $key => $a) {
            $data['itemHeight'.($key + 1)] = $a;
        }
        
        foreach ($comprimentos as $key => $c) {
            $data['itemLength'.($key + 1)] = $c;
        }

        $data['shippingType'] = $request->tipoServ;
        $data['shippingAddressPostalCode'] = $request->cep;
        $data['shippingAddressStreet'] = $request->endereco;
        $data['shippingAddressNumber'] = $request->numero_endereco;
        $data['shippingAddressComplement'] = $complemento;
        $data['shippingAddressDistrict'] = $request->bairro;
        $data['shippingAddressCity'] = $request->cidade;
        $data['shippingAddressState'] = $request->estado;
        $data['shippingAddressCountry'] = $request->pais;
        $data['senderName'] = $request->nome;
        $data['senderCPF'] = $request->numero_cpf;
        $data['senderAreaCode'] = $ddd;
        $data['senderPhone'] = $telefone;
        $data['senderEmail'] = $request->email_cliente;
        $data['redirectURL'] = route('cart.result.page');

        //dd($data);

        $url = 'https://ws.pagseguro.uol.com.br/v2/checkout';

        $data = http_build_query($data);

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $xml = curl_exec($curl);

        //dd($xml);

        curl_close($curl);

        $xml = simplexml_load_string($xml);

        return response()->json(['codigoCompra' => $xml->code]);
        
        /* $data = [
             'items' => [
                 [
                     'id' => '1',
                     'description' => $request->descricao,
                     'quantity' => $request->quantidade,
                     'amount' => $request->valor,
                     'weight' => $request->peso,
                     'shippingCost' => '',
                     'width' => $request->largura,
                     'height' => $request->altura,
                     'length' => $request->comprimento,
                 ],
             ],
             'shipping' => [
                 'address' => [
                     'postalCode' => '11702690',
                     'street' => 'Rua Jose Calixto do Carmo',
                     'number' => '111',
                     'district' => 'Aviação',
                     'city' => 'Praia Grande',
                     'state' => 'SP',
                     'country' => 'BRA',
                 ],
                 'type' => '',
                 'cost' => '',
             ],
             'sender' => [
                 'email' => $request->email_cliente,
                 'name' => $request->nome,
                 'documents' => [
                     [
                         'number' => $request->numero_cpf,
                         'type' => 'CPF'
                     ]
                 ],
                 'phone' => '13974082536',
                 'bornDate' => '2018-07-27',
             ]
         ];*/

       /* $r = new PagSeguro;


        $checkout = $r->checkout()->createFromArray($data);

        dd($checkout);*/

        /*$credentials = $p->credentials()->get();

        $information = $checkout->send($credentials); // Retorna um objeto de laravel\pagseguro\Checkout\Information\Information
        if ($information) {
            print_r($information->getCode());
            print_r($information->getDate());
            print_r($information->getLink());
        }*/
    }

    public function deleteProduct(Request $request)
    {
        //dd($request->all());

        $carrinho = Session::get('cart');
        $qtdCarrinho = Session::get('qtCart');
        $qtdItensCarrinho = Session::get('qtCartItems');

        $precoSubTotal = Session::get('subtotalPrice');

        $alturaTotal = Session::get('totalHeight');
        $alturaTotalIndividual = $carrinho[$request->cod_produto_carrinho]['alturaTotalProduto'];

        $larguraTotal = Session::get('totalWidth');
        $larguraTotalIndividual = $carrinho[$request->cod_produto_carrinho]['larguraTotalProduto'];

        $comprimentoTotal = Session::get('totalLength');
        $comprimentoTotalIndividual = $carrinho[$request->cod_produto_carrinho]['comprimentoTotalProduto'];

        $pesoTotal = Session::get('totalWeight');
        $pesoTotalIndividual = $carrinho[$request->cod_produto_carrinho]['pesoTotalProduto'];

        //dd($qtdCarrinho);

        $qtdProdExcluido = $carrinho[$request->cod_produto_carrinho]['qtdIndividual'];

        $valorTotalProdExcluido = $carrinho[$request->cod_produto_carrinho]['valorTotalProduto'];

        $precoSubTotal -= $valorTotalProdExcluido;

        //dd($qtdProdExcluido);

        $qtdCarrinho -= $qtdProdExcluido;

        $alturaTotal -= $alturaTotalIndividual;
        $larguraTotal -= $larguraTotalIndividual;
        $comprimentoTotal -= $comprimentoTotalIndividual;
        $pesoTotal -= $pesoTotalIndividual;

        $qtdItensCarrinho--;

        unset($carrinho[$request->cod_produto_carrinho]);

        session([ 'cart' => $carrinho ]);
        session([ 'qtCart' => $qtdCarrinho ]);
        session([ 'qtCartItens' => $qtdItensCarrinho ]);

        session([ 'totalHeight' => $alturaTotal ]);
        session([ 'totalWidth' => $larguraTotal ]);
        session([ 'totalLength' => $comprimentoTotal ]);
        session([ 'totalWeight' => $pesoTotal ]);

        session([ 'subtotalPrice' => $precoSubTotal ]);

        return redirect()->route('cart.page')->with('success', 'Item excluído com sucesso');
    }

    public function clearCart(Request $request)
    {
        Session::forget('cart');
        Session::forget('qtCart');
        Session::forget('qtCartItens');

        Session::forget('totalHeight');
        Session::forget('totalWidth');
        Session::forget('totalLength');
        Session::forget('totalWeight');

        Session::forget('orderData');
        Session::forget('creditCardInfo');

        Session::forget('subtotalPrice');
        Session::forget('totalPrice');

        return redirect()->route('cart.page')->with('success', 'Itens excluídos do carrinho');
    }

    public function clearShippingData()
    {
        Session::forget('shippingData');
    }

    public function addQuantityCart($idx)
    {
        $carrinho = Session::get('cart');
        $qtdCart = Session::get('qtCart');

        $precoSubTotal = Session::get('subtotalPrice');
        $precoTotal = Session::get('totalPrice');

        $alturaTotal = Session::get('totalHeight');
        $alturaTotalIndividual = $carrinho[$idx]['alturaTotalProduto'];

        $larguraTotal = Session::get('totalWidth');
        $larguraTotalIndividual = $carrinho[$idx]['larguraTotalProduto'];

        $comprimentoTotal = Session::get('totalLength');
        $comprimentoTotalIndividual = $carrinho[$idx]['comprimentoTotalProduto'];

        $pesoTotal = Session::get('totalWeight');
        $pesoTotalIndividual = $carrinho[$idx]['pesoTotalProduto'];

        $qtInd = $carrinho[$idx]['qtdIndividual'];
        $vlProd = $carrinho[$idx]['valorProduto'];

        $alturaTotal += $carrinho[$idx]['alturaProduto'];
        $alturaTotalIndividual += $carrinho[$idx]['alturaProduto'];

        $larguraTotal += $carrinho[$idx]['larguraProduto'];
        $larguraTotalIndividual += $carrinho[$idx]['larguraProduto'];

        $comprimentoTotal += $carrinho[$idx]['comprimentoProduto'];
        $comprimentoTotalIndividual += $carrinho[$idx]['comprimentoProduto'];

        $pesoTotal += $carrinho[$idx]['pesoProduto'];
        $pesoTotalIndividual += $carrinho[$idx]['pesoProduto'];

        $qtInd += 1;

        $carrinho[$idx]['qtdIndividual'] = $qtInd;

        $carrinho[$idx]['alturaTotalProduto'] = $alturaTotalIndividual;
        $carrinho[$idx]['larguraTotalProduto'] = $larguraTotalIndividual;
        $carrinho[$idx]['comprimentoTotalProduto'] = $comprimentoTotalIndividual;
        $carrinho[$idx]['pesoTotalProduto'] = $pesoTotalIndividual;
 
        $vTotal = $vlProd * $qtInd;

        $precoSubTotal += $vlProd;
        $precoTotal += $vlProd;

        $carrinho[$idx]['valorTotalProduto'] = $vTotal;
        $qtdCart += 1;

        session([ 'cart' => $carrinho ]);
        session([ 'qtCart' => $qtdCart ]);

        session([ 'totalHeight' => $alturaTotal ]);
        session([ 'totalWidth' => $larguraTotal ]);
        session([ 'totalLength' => $comprimentoTotal ]);
        session([ 'totalWeight' => $pesoTotal ]);

        session([ 'subtotalPrice' => $precoSubTotal ]);
        session([ 'totalPrice' => $precoTotal ]);

        Session::save();

        return response([
                'cartSession' => Session::get('cart'),
                'qtCarrinho' => Session::get('qtCart'),
                'qtProdEstoque' => $carrinho[$idx]['qtdProdutoEstoque'],
                'subTotal' => Session::get('subtotalPrice'),
                'total' => Session::get('totalPrice')
            ]);
    }

    public function removeQuantityCart($idx)
    {
        $carrinho = Session::get('cart');
        $qtdCart = Session::get('qtCart');

        $precoSubTotal = Session::get('subtotalPrice');
        $precoTotal = Session::get('totalPrice');

        $alturaTotal = Session::get('totalHeight');
        $alturaTotalIndividual = $carrinho[$idx]['alturaTotalProduto'];

        $larguraTotal = Session::get('totalWidth');
        $larguraTotalIndividual = $carrinho[$idx]['larguraTotalProduto'];

        $comprimentoTotal = Session::get('totalLength');
        $comprimentoTotalIndividual = $carrinho[$idx]['comprimentoTotalProduto'];

        $pesoTotal = Session::get('totalWeight');
        $pesoTotalIndividual = $carrinho[$idx]['pesoTotalProduto'];

        $qtInd = $carrinho[$idx]['qtdIndividual'];
        $vlProd = $carrinho[$idx]['valorProduto'];

        $alturaTotal -= $carrinho[$idx]['alturaProduto'];
        $alturaTotalIndividual -= $carrinho[$idx]['alturaProduto'];

        $larguraTotal -= $carrinho[$idx]['larguraProduto'];
        $larguraTotalIndividual -= $carrinho[$idx]['larguraProduto'];

        $comprimentoTotal -= $carrinho[$idx]['comprimentoProduto'];
        $comprimentoTotalIndividual -= $carrinho[$idx]['comprimentoProduto'];

        $pesoTotal -= $carrinho[$idx]['pesoProduto'];
        $pesoTotalIndividual -= $carrinho[$idx]['pesoProduto'];

        $qtInd -= 1;

        $carrinho[$idx]['qtdIndividual'] = $qtInd;
        
        $vTotal = $vlProd * $qtInd;

        $precoSubTotal -= $vlProd;
        $precoTotal -= $vlProd;

        $carrinho[$idx]['valorTotalProduto'] = $vTotal;
        $qtdCart -= 1;

        session([ 'cart' => $carrinho ]);
        session([ 'qtCart' => $qtdCart ]);

        session([ 'totalHeight' => $alturaTotal ]);
        session([ 'totalWidth' => $larguraTotal ]);
        session([ 'totalLength' => $comprimentoTotal ]);
        session([ 'totalWeight' => $pesoTotal ]);

        session([ 'subtotalPrice' => $precoSubTotal ]);
        session([ 'totalPrice' => $precoTotal ]);

        Session::save();

        return response([
            'cartSession' => Session::get('cart'),
            'qtCarrinho' => Session::get('qtCart'),
            'qtProdEstoque' => $carrinho[$idx]['qtdProdutoEstoque'],
            'subTotal' => Session::get('subtotalPrice'),
            'total' => Session::get('totalPrice')
        ]);
    }

    public function saveCartRoute(Request $request)
    {
        if (!(Session::has('cartRoute'))) {
            Session::put('cartRoute', 'cart.page');
        }

        Session::save();

        return response()->json([ 'result' => 'Ok' ]);
    }
}
