<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Produto;
use App\Services\VendaService;
use App\Models\Pedido;
use App\Models\ItensPedido;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $data = [];

        //Buscar todos os produtos
        $listaProdutos = Produto::all();
        $data['lista'] = $listaProdutos;

        return view("home", $data);
    }

    public function categoria($idcategoria = 0, Request $request)
    {
        $data = [];

        //SELECT * FROM categorias
        $listaCategorias = Categoria::all();

        //SELECT * FROM produtos limit 4
        $queryProduto = Produto::limit(4);

        if ($idcategoria != 0) {
            //where categoria_id = $idcategoria
            $queryProduto->where("categoria_id", $idcategoria);
        }

        $listaProdutos = $queryProduto->get();

        $data["lista"] = $listaProdutos;
        $data["listaCategoria"] = $listaCategorias;
        $data["idcategoria"] = $idcategoria;
        return view("categoria", $data);
    }
    public function adicionarCarrinho($idProduto = 0, Request $request)
    {
        //Buscar o produto por id
        $prod = Produto::find($idProduto);

        if ($prod) {
            //Encontrou um produto

            //Buscar da sessão o carrnho atual
            $carrinho = session('cart', []);

            array_push($carrinho, $prod);
            session(['cart' => $carrinho]);
        }

        return redirect()->route("home");
    }
    public function verCarrinho(Request $request)
    {
        $carrinho = session('cart', []);
        $data = ['cart' => $carrinho];

        return view("carrinho", $data);
    }
    public function excluirCarrinho($indice, Request $request)
    {
        $carrinho = session('cart', []);
        if (isset($carrinho[$indice])) {
            unset($carrinho[$indice]);
        }
        session(['cart' => $carrinho]);
        return redirect()->route("ver_carrinho");
    }

    public function finalizar(Request $request)
    {
        $prods = session('cart', []);
        $vendaService = new VendaService();
        $result = $vendaService->finalizarVenda($prods, \Auth::user());


        if ($result["status"] == "ok") {
            $request()->session()->forget("cat");
        }

        $request->session()->flash($result["status"], $result["message"]);
        return redirect()->route("ver_carrinho");
    }
    public function historico(Request $request)
    {
        $data = [];

        //pegar o id o usuario logado
        $idusuario = \Auth::user()->id();

        $listaPedido = Pedido::where("usuario_id", $idusuario)
                        ->orderBy("datapedido", "desc")
                        ->get();
        $data["lista"] = $listaPedido;

        return view("compra/historico", $data);
    }
    public function detalhes(Request $request){
        $idpedido = $request->input("idpedido");

        $listaItens = ItensPedido::join("produtos", "produtos.id", "=", "itens_pedidos.produto_id")
                    ->where("pedido_id", $idpedido)
                    ->get(['itens_pedidos.=', 'itens_pedidos.valor as valoritem', 'produtos.*']);

        $data = [];
        $data["listaItens"] = $listaItens;
        return view("compra/detalhes", $data);           
    }
}