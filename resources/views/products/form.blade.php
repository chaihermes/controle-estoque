@extends('layouts.app')

@section('content')         <!--função do blade chamada section.-->


    <!--Criando o formulário de cadastro de produtos-->
    <section class="container d-flex flex-column justify-content-center">
        <form action="/produtos/cadastrar" method="POST" enctype="multipart/form-data" class="card-body col-md-6 form-label">
            @csrf
            <div class="form-group d-flex justify-content-center">
                <h3>Formulário de Cadastro de Produto</h3>
            </div>
            <div class="form-group">
                <label for="nameProduct">Nome do Produto</label>
                <input class="form-control" type="text" name="nameProduct" id="nameProduct">
            </div>
            <div class="form-group">
                <label for="descriptionProduct">Descrição do Produto</label>
                <input class="form-control" type="text" name="descriptionProduct" id="descriptionProduct">
            </div>
            <div class="form-group">
                <label for="quantityProduct">Quantidade</label>
                <input class="form-control" type="number" name="quantityProduct" id="quantityProduct">
            </div>
            <div class="form-group">
                <label for="priceProduct">Preço</label>
                <input class="form-control" type="number" name="priceProduct" id="priceProduct" min = "0" value = "0" step = "0.01">
            </div>
            <div class="form-group">
                <label for="imageProduct">Insira a Imagem</label>
                <input class="form-control" type="file" name="imageProduct">
            </div>
            <div class="form-group d-flex justify-content-end">
                <button type="submit" class="btn btn-outline-success ">Cadastrar</button>
            </div>
        </form>

        <div class="row"> 
            <div class="col-md-12">
                @if(isset($result))             <!--verificando se a variável existe-->
                    @if($result)
                        <h3>Cadastro realizado com sucesso!</h3>
                    @else
                        <h1>Não foi possível fazer o cadastro</h1>
                    @endif
                @endif
            </div>
        </div>

    </section>

@endsection