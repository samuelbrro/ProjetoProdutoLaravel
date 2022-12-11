@extends("layout");
@section("scriptjs");
<script>
$(function(){
    $(".infocompra").on('click', function() =>{ 
        //ao clicar no link com a class .infocompra está função sera executada
        let id = $(this).attr("data-value");
        $.post('{{ route("compra_detalhes") }}', { idpedido : id  }, (result) => {
            //função de callback -- retorno do ajax
            $("#conteudopedido").html(result)
        })
    }
})    
</script>
@endsection
@section("conteudo")

    <div class="col-12">
        <h2>Minhas compras</h2>
    </div>

    <div class="col-12">
        <table class="table table-bordered">
            <tr>
                <th>Data da compra</th>
                <th>Situação da compra</th>
            </tr>
            @foreach ($lista as $ped)
             <tr>
                <td>{{ $ped->datapedido->format("d/m/Y H:i:") }}</td>
                <td>{{ $ped->statusDesc()}}</td>
                <td>
                    <a href="#" class="btn btn-sm btn-info infocompra" data-value="{{ $ped->id }}" data-toggle="modal" data-target="#modalcompra">
                        <img src="https://img.icons8.com/ios/50/null/shopping-basket.png"/>
                    </a>
                </td>    
            </tr>       
            @endforeach
        </table>
    </div> 
    
    <div class="modal fade" id="modalcompra">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalhes da compra</h5>
                </div>
                <div class="modal-body">
                    <div id="conteudopedido"></div>
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-sm btn-seconday" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

