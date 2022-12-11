<?php

namespace App\Services;

use App\Models\Usuario;
use App\Models\Endereco;
use Log;


class ClienteService {
    public function salvarUsuario(Usuario $user, Endereco $endereco){
        try {
            //Buscando um usuario com o login que deve ser salvo no banco
            $dbUsuario = Usuario::where("login", $user->login)->first();
            if($dbUsuario){
                return ['status' => 'err', 'message' => 'Login já cadastrado no sistema'];
            }
            \DB::beginTransaction();//Iniciar a transação
            $user->save(); //salvar o usuario
            $endereco->usuario_id = $user->id; //Relacionamento das tabelas
            $endereco->save(); //Salvar as tabelas
            \DB::commit(); //Confirmando a transação

            return ['status' => 'ok', 'message' => 'Usuario cadastrado com sucesso!'];
        }catch(\Exception $e){  
            //Tratar o erro
            \Log::error("Erro", ['file' => 'ClienteService.salvarUsuario', 
                            'message' => $e->getMessage()]);
            \DB::rollback();//cancelar a transação
            return ['status' => 'err', 'message' => 'Usuario não cadastrado'];
        }
    }
}