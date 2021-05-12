<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->id('id')->autoIncrement()->comment('id');
            $table->string('username', 50)->comment('ユーザー名');
            $table->string('password', 128)->comment('パスワード');
            $table->timestamp('created_at')->comment('作成日時')->nullable();
            $table->timestamp('updated_at')->comment('更新日時')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_accounts');
    }
}
