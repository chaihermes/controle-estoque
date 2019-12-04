<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();     //nullable: pode ser nulo.
            $table->string('password')->nullable();
            $table->string('provider_id')->unique();         //id do usuário do google
            $table->string('img_profile', 300);     //criamos novas colunas
            $table->integer('active');              //usuário ativo ou inativo 
            $table->rememberToken();
            $table->timestamps();   //cria automaticamente as colunas de create_at e update_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
