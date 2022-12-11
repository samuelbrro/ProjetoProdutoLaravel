<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <title>ShopVendas</title>
    @yield("scriptjs")
</head>
<body>
    <nav class="navbar navbar-light navbar-expand-md bg-light pl-5 pr-5 mb-5">
        <a class="navbar-brand" href="#">ShopVendas</a>
        <div class="collapse navbar-collapse">
            <div class="navbar-nav">
              <a class="nav-link" href="{{ route('home') }}">Home</a>
              <a class="nav-link" href="{{ route('categoria') }}">Categorias</a>
              <a class="nav-link" href="{{ route('cadastrar') }}">Cadastro</a>
                @if(!\Auth::user())
                    <a class="nav-link" href="{{ route('logar') }}">Logar</a>
                @else  
                    <a class="nav-link" href="{{ route('compra_historico') }}">Minhas compras</a>  
                    <a class="nav-link" href="{{ route('sair') }}">Logout</a>  
              @endif
            </div>
        </div>
        <a href="{{ route ('ver_carrinho') }}" class="btn btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </svg></a>
      </nav>
      <div class="container">
        <div class="row">

            @if(\Auth::user())
                <div class="col-12">
                    <p class="text-right">
                        Seja bem vindo, {{ \Auth::user()->nome }}, <a href="{{ route('sair') }}">Sair</a></p>
                </div>

            @endif

            @if($message = Session::get('err'))
                <div class="col-12">
                    <div class="alert alert-danger">{{ $message }}</div>
                </div>
            @endif


            @if($message = Session::get('ok'))
                <div class="col-12">
                    <div class="alert alert-success">{{ $message }}</div>
                </div>
            @endif

            <!-- Nesta DIV teremos uma área que os arquivos que irão adicionar conteúdo-->
            @yield("conteudo")
        </div>
    </div>

</body>
</html>

