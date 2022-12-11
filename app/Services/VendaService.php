<?php


namespace App\Services;
use Log;
use App\Models\Usuario;
use App\Models\Pedido;
use App\Models\ItensPedido;


class VendaService{
    public function finalizarVenda($prods = [], Usuario $user)
    {
        try {
            \DB::beginTransaction();

            $pedido = new Pedido();
            $dthoje = new \DateTime();

            $pedido->datapedido = $dthoje->format('Y-m-d H:i:s');  
            $pedido->status = "PEN";            
            $pedido->usuario_id = $user_id;
            
            $pedido->save();

            foreach($prods as $p){
                $itens = new ItensPedido();

                $itens->quantidade = 1;
                $itens->valor = $p->valor;
                $itens->dt_item = $dthoje->format('Y-m-d H:i:s');
                $itens->produto_id = $p->id;
                $itens->pedido_id = $pedido->id;
                $itens->save();

            }
            
            \DB::commit();
            return ['status' => 'ok', 'message' => 'Venda finalizada com sucesso!'];
        } catch(\Exception $e) {
            \DB::rollback();
            Log::error("ERRO: VENDA SERVICE", ['message' => $e->getMessage()]);
            return ['status' => 'err', 'message' => 'Venda não pode ser finalizada'];
        }
    }
}