<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/1/3
 * Time: 16:21
 */


class MessageTableSeeder extends \Illuminate\Database\Seeder
{

    public function run()
    {
        factory(\App\Models\Message::class, 50)->create();
    }
}