<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/1/3
 * Time: 16:21
 */


class ArticleTableSeeder extends \Illuminate\Database\Seeder
{

    public function run()
    {
        factory(\App\Models\Article::class, 50)->create();
    }
}