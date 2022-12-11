<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $cat = new \App\Models\Categoria(['categoria' => 'Geral']);
        $cat->save();

        $prod = new \App\Models\Produto(['nome' => 'Produto 1', 'valor' => 10, 'foto' => 'img/product-1.jpg', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod -> save();

        $prod1 = new \App\Models\Produto(['nome' => 'Produto 2', 'valor' => 10, 'foto' => 'img/product-2.jpg', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod1 -> save();

        $prod2 = new \App\Models\Produto(['nome' => 'Produto 3', 'valor' => 10, 'foto' => 'img/product-3.jpg', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod2 -> save();

        $prod3 = new \App\Models\Produto(['nome' => 'Produto 4', 'valor' => 10, 'foto' => 'img/product-4.jpg', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod3 -> save();

        $prod4 = new \App\Models\Produto(['nome' => 'Produto 5', 'valor' => 10, 'foto' => 'img/product-5.jpg', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod4 -> save();

        $prod5 = new \App\Models\Produto(['nome' => 'Produto 6', 'valor' => 10, 'foto' => 'img/product-6.jpg', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod5 -> save();

        $prod6 = new \App\Models\Produto(['nome' => 'Produto 7', 'valor' => 10, 'foto' => 'img/product-7.jpg', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod6 -> save();

        $prod7 = new \App\Models\Produto(['nome' => 'Produto 8', 'valor' => 10, 'foto' => 'img/product-8.jpg', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod7 -> save();

        $prod8 = new \App\Models\Produto(['nome' => 'Produto 9', 'valor' => 10, 'foto' => 'img/product-9.jpg', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod8 -> save();

        $prod9 = new \App\Models\Produto(['nome' => 'Produto 10', 'valor' => 10, 'foto' => 'img/product-10.jpg', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod9 -> save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
