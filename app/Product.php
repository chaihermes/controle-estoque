<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //public $tableName = "products";     //se por algum motivo a tabela não estiver no plural, com essa função, 
    //public $primaryKey = "id";          //ela fica no plural.
    //public $timestamps = false;

    //A lista de produtos contém a informação de id de usuário. A função users cria a associação com a tabela users e 
    //retornar o id de cada usuário que cadastrou cada produto. Se não fizer assim, teria que fazer com um foreach.

    //para o LARAVEL quando usa funções no plural, "users", ele entende que existe uma relação de n:n
    public function user(){         
        return $this->belongsTo('App\User');       
    }

}
