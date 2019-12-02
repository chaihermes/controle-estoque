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

        return view('products.formRegister', ["result"=>$result]);  //o resultado da função é enviado pra view, através de um objeto
    }

    public function viewForm(Request $request){
        return view('products.formRegister');           //aqui usa . ao invés de /, dentro da pasta products, existe o arquivo form.blade.php
    }

    public function viewFormUpdate(Request $request, $id=0){  //pegando o id e retornar o formulário de atualização do pproduto
        //o id=0 é um valor pré determinado, assim, o preenchimento do id, que é opcional, com 0 não existe.
        $product = Product::find($id);                 //find-> faz o select*from na tabela de produtos. Procura no BD.
        if($product){
            return view('products.formUpdate', ["product"=>$product]);      //precisa passar a informação como array associativo. "product" é o nome do array. A variável $product vai pra view.
        } else {
            return view('products.formUpdate');
        }
        //esse if verifica a existência ou não do id informado. Se o id existe, retorna o formulário com o produto pra atualizar, 
        //caso contrário, cai no else do formUpdate.blade.php.
    }

    public function update(Request $request){
        //funciona da mesma forma que criar
        //para atualizar devemos buscar um objeto para criar. o 3 é o parâmetro que queremos atualizar. é o id do produto cadastrado.
        //Buscamos um objeto através do ::find(idProduto)
        //Será necessário usar rotas com parâmetro
        $product = Product::find($request->idProduct);
        $product->name = $request->nameProduct;      
        $product->description = $request->descriptionProduct;
        $product->quantity = $request->quantityProduct;
        $product->price = $request->priceProduct;
        
        $result = $product->save(); 

        return view('products.formUpdate', ["result"=>$result]);
    }


    public function delete(Request $request, $id=0){
        //para deletar, será necessário usar Product::destroy($id)
        $result = Product::destroy($id);

        if($result){
            return redirect('/produtos');
        }
    }


    public function viewAllProducts(Request $request){
        //vai precisar do Product::All
        $listProducts = Product::all();
        return view('products.products', ['listProducts'=>$listProducts]);       //o primeiro é o nome da pasta, o segundo é o nome da view.
    }

    public function viewOneProduct(Request $request){
        //vai precisar do Product::find($idProduct)
    }
}
