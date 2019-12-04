@extends('layouts.app') 

@section('content')

    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Produtos</h2>
            </div>

            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Nome do Produto</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Usuário</th>
                            <th scope="col">Criado em:</th>
                            <th scope="col">Última Atualização:</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($listProducts as $product)
                        <tr>
                            <th scope="row">{{$product->id}}</th>
                            <td>{{$product->name}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>R$ {{$product->price}}</td>
                            <td>{{$product->user->name}}</td>
                            <td>{{$product->created_at}}</td>
                            <td>{{$product->updated_at}}</td>
                            <td>
                                <a href="/produtos/atualizar/{{$product->id}}" class="btn btn-outline-primary">Atualizar</a>
                                <a href="/produtos/deletar/{{$product->id}}" class="btn btn-outline-danger">Deletar</a>
                            </td>
                        </tr>
                    @empty
                        <h3>Não tem produtos cadastrados</h3>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </section>


@endsection