<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/1/8
 * Time: 14:12
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class FriendLink extends Model
{
    public static function add(array $data)
    {
        $friendLink = new FriendLink();
        !empty($data['name']) && $friendLink->name = $data['name'];
        !empty($data['logo']) && $friendLink->logo = $data['logo'];
        !empty($data['url']) && $friendLink->url = $data['url'];
        !empty($data['sort']) && $friendLink->sort = (int)$data['sort'];
        !empty($data['is_public']) && $friendLink->is_public = (int)$data['is_public'];
        return $friendLink->save();

    }

    public static function edit(FriendLink $friendLink, $data)
    {

        !empty($data['name']) && $friendLink->name = $data['name'];
        !empty($data['logo']) && $friendLink->logo = $data['logo'];
        !empty($data['url']) && $friendLink->url = $data['url'];
        !empty($data['sort']) && $friendLink->sort = (int)$data['sort'];
        !empty($data['is_public']) && $friendLink->is_public = (int)$data['is_public'];

        return $friendLink->update();
    }

    public static function lists()
    {
        return FriendLink::get();
    }

    public static function status(FriendLink $friendLink)
    {
        $friendLink->is_public = !$friendLink->is_public;
        $friendLink->update();
    }

    public static function del(array $ids)
    {
        return FriendLink::whereIn('id', $ids)->delete();
    }
}