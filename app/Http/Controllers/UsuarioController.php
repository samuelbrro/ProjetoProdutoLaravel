<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UsuarioController extends Controller
{
    public function logar(Request $request){
        $data = [];

        if($request->isMethod("POST")){
            //Se entrar neste IF é por que o usuário clicou no botão Logar
            $login = $request->input("login");
            $login = $request->input("senha");

            $login = preg_replace('/[^0-9]/', '', $login);


            $credentials = ['login' => $login, 'password' => $senha];
            //logar 
            if(Auth::attempt($credential)){
                return redirect()->route("home");
            }else{
                $request->session()->flash("err", "Usuário / senha inválido!");
                return redirect()->route("Logar"); 
            }
        }

        return view("logar", $data);
    }
    public function sair(Request $request){
        //deslogar do usuario
        Auth::logout();
        return redirect()->route("home");
    }
}
