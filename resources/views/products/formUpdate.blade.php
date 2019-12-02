@extends('layouts.app')

@section('content')         <!--função do blade chamada section.-->


    <!--Criando o formulário de cadastro de produtos-->
    <section class="container d-flex flex-column">
        <div class="row justify-content-center">
        <!--valida a informação do id antes de exibir o formulário-->
        @if(isset($product))
            <form action="/produtos/atualizar" method="POST" enctype="multipart/form-data" class="card-body col-md-6 form-label">
                @csrf
                <input type="text" name="idProduct" id="" value="{{$product->id}}" hidden>  <!--o usuário não visualiza esse campo, só está puxando o atributo id do objeto $product-->
                <div class="form-group d-flex justify-content-center">
                    <h3>Formulário de Atualização de Produtos</h3>
                </div>
                <div class="form-group">
                    <label for="nameProduct">Nome do Produto</label>
                    <input class="form-control" type="text" name="nameProduct" id="nameProduct" value="{{$product->name}}"> <!--o value busca no objeto product o name das tabela-->
                </div>
                <div class="form-group">
                    <label for="descriptionProduct">Descrição do Produto</label>
                    <textarea class="form-control" type="text" name="descriptionProduct" id="descriptionProduct" >{{$product->description}}</textarea>      <!--no textarea não existe value, então fica entre as tags-->
                </div>
                <div class="form-group">
                    <label for="quantityProduct">Quantidade</label>
                    <input class="form-control" type="number" name="quantityProduct" id="quantityProduct" value="{{$product->quantity}}">
                </div>
                <div class="form-group">
                    <label for="priceProduct">Preço</label>
                    <input class="form-control" type="number" name="priceProduct" id="priceProduct" step = "0.01" value="{{$product->price}}">
                </div>
                <div class="form-group">
                    <label for="imageProduct">Insira a Imagem</label>
                    <input class="form-control" type="file" name="imageProduct">
                </div>
                <div class="form-group d-flex justify-content-end">
                    <button type="submit" class="btn btn-outline-success ">Atualizar</button>
                </div>
            </form>

        @elseif(isset($result))
        <!--Se o $result (do ProductController) estiver válido não entrar no else. Não faz nada.-->
        
        @else
            <h3>Você não passou um id ou o produto não existe.</h3>
            <!--validação para ter certeza que o id informado existe e é válido -->
        @endif
        </div>

        <div class="row"> 
            <div class="col-md-6">
                @if(isset($result))             <!--verificando se a variável existe-->
                    @if($result)
                        <h3>Atualização realizada com sucesso!</h3> <!--retorno para o usuário-->
                    @else
                        <h3>Não foi possível fazer a atualização</h3>
                    @endif
                @endif
            </div>
        </div>

    </section>

@endsection