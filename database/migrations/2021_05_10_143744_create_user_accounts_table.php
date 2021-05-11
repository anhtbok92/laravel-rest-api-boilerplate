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
            $table->string('mail_address', 254)->comment('メールアドレス');
            $table->string('password', 128)->comment("パスワード");
            $table->string('family_name', 100)->comment('姓(氏名)');
            $table->string('first_name', 100)->comment('名(氏名)');
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
