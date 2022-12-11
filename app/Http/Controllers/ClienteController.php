<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Endereco;
use APP\Services\ClienteService;



class ClienteController extends Controller{

    public function cadastrar(Request $request)
    {
        $data = [];

        return view("cadastrar", $data);
    }

    public function cadastrarCliente(Request $request){
        //Pegar todos os valores do formulario
        $values = $request->all();
        $usuario = new Usuario();
        //$usuario-cpf = $request->input("cpf", "" );
        $usuario->fill($values);
        $usuario-> login = $request->input("cpf", "");

        $senha = $request->input("password", "");
        $usuario->password = \Hash::make($senha); //Criptografar

        $endereco = new Endereco($values);
        $endereco->logradouro = $request->input("endereco", "");

        $clienteService = new ClienteService();
        $result = $clienteService->salvarUsuario($usuario, $endereco);

        $message = $result["message"];
        $status = $result["status"];
        
        //os, cadastrado com sucesso
        //err, Usuario não poder ser cadastrado
        $request->session()->flash($status, "message");

        return redirect()->route("cadastrar");
    }
}
