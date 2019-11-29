<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;           //incluímos essa classe pra ser usada aqui.

use App\Product;        //importamos a classe Product pra ser usada aqui.

//use Auth;             Dessa forma também funciona o Auth, aí não precisa fazer a função Auth()->

class ProductController extends Controller
{
    public $nome; 

    public function create(Request $request){           //o $request armazena as informações que vem pelo método Request.
        
        //essa função if pega as informações recebidas pelo $request, especifica o método GET e envia para o 
        //formulário
        // if($request->isMethod('GET')){
        //     return view('formulario');
        // } else {
        //     //faço o cadastro do produto.
        // }

        //o método create fica responsável por cadastrar um produto.

        //dd($request->nameProduct); teste de impressão do nome do produto na tela.

        $newProduct = new Product();
        $newProduct->name = $request->nameProduct;      //name é o campo da coluna na tabela. O nameProduct é o nome que chamamos o name dentro do formulário.
        $newProduct->description = $request->descriptionProduct;
        $newProduct->quantity = $request->quantityProduct;
        $newProduct->price = $request->priceProduct;
        $newProduct->user_id = Auth()->user()->id;        //pela super global Auth, está recuperando o id do usuário que está logado.
        
        $result = $newProduct->save();                //está salvando o objeto. A query já está pronta dentro do Laravel.
                                //com o save está salvando as informações no BD. O resultado dessa função é um booleano
                                //se der true, salvou no BD, caso contrário, false, não salva.
        
        //teste pra verificar se salvou no banco de dados.
        // if($result){
        //     echo "Deu certo sem query!";
        // } else {
        //     echo "Vai ter que criar!";
        // }

        return view('products.form', ["result"=>$result]);  //o resultado da função é enviado pra view, através de um objeto
    }

    public function viewForm(Request $request){
        return view('products.form');           //aqui usa . ao invés de /, dentro da pasta products, existe o arquivo form.blade.php
    }


    public function update(Request $request){
        //funciona da mesma forma que criar
        //para atualizar devemos buscar um objeto para criar. o 3 é o parâmetro que queremos atualizar. é o id do produto cadastrado.
        //Buscamos um objeto através do ::find(idProduto)
        //Será necessário usar rotas com parâmetro
        $newProduct = Product::find(3);
        $newProduct->name = $request->nameProduct;      //name é o campo da coluna na tabela. O nameProduct é o nome que chamamos o name dentro do formulário.
        $newProduct->description = $request->descriptionProduct;
        $newProduct->quantity = $request->quantityProduct;
        $newProduct->price = $request->priceProduct;
        $newProduct->user_id = Auth()->user()->id;  
    }


    public function delete(Request $request){
        //para deletar, será necessário usar Product::destroy($id)
    }


    public function viewAllProducts(Request $request){
        //vai precisar do Product::All
    }

    public function viewOneProduct(Request $request){
        //vai precisar do Product::find($idProduct)
    }
}
