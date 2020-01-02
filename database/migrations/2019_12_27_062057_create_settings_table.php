<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',20)->default('')->comment('网站名称');
            $table->string('logo',50)->default('')->comment('LOGO');
            $table->string('url',30)->default('')->comment('网址');
            $table->string('copyright',50)->default('')->comment('版权信息');
            $table->string('hotline',20)->default('')->comment('客服热线');
            $table->string('contact',10)->default('')->comment('联系人');
            $table->string('mobile',11)->default('')->comment('手机号');
            $table->string('email',20)->default('')->comment('邮箱');
            $table->string('record_sn',20)->default('')->comment('备案号');
            $table->string('address',30)->default('')->comment('备案号');
            $table->string('statistics',300)->default('')->comment('备案号');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
