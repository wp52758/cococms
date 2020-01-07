<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id')->index()->default(0)->comment('分类ID');
            $table->string('title',50)->comment('标题');
            $table->string('abstract',30)->default('')->comment('摘要、概要');
            $table->string('keyword',20)->default('')->comment('关键字，多个关键字用半角逗号分隔');
            $table->string('main_pic',30)->default('')->comment('主图');
            $table->string('group_pic',30)->default('')->comment('组图');
            $table->string('link',100)->default('')->comment('跳转链接');
            $table->text('content')->comment('详情');
            $table->boolean('is_top')->default(0)->comment('是否置顶，0：否，1：是');
            $table->boolean('is_recommended')->default(0)->comment('是否推荐，0：否，1：是');
            $table->boolean('is_rolling')->default(0)->comment('是否滚动，0：否，1：是');
            $table->boolean('is_release')->default(1)->comment('是否发布，0：否，1：是');
            $table->integer('sort')->default(0)->comment('排序');
            $table->string('file',30)->default('')->comment('下载文件地址');
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
        Schema::dropIfExists('articels');
    }
}
