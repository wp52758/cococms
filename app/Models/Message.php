<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/1/3
 * Time: 11:54
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public static function lists(int $page = 0, int $parPage = 20)
    {

        $message = Message::orderBy('id','DESC');

        return $message->paginate($parPage, ['*'], 'page', $page);
    }
}