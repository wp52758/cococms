<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/1/9
 * Time: 17:54
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    public function child()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }

    public static function add(array $data)
    {
        $menu = new Menu();
        !empty($data['parent_id']) && $menu->parent_id = (int)$data['parent_id'];
        $menu->name = $data['name'];
        return $menu->save();

    }

    public static function edit(Menu $menu, $data)
    {
        !empty($data['parent_id']) && $menu->parent_id = (int)$data['parent_id'];
        $menu->name = $data['name'];
        return $menu->update();
    }

    public static function lists()
    {
        return Menu::with('child.child.child')->where('parent_id',0)->get();
    }

    public static function del(array $ids)
    {
        return Menu::whereIn('id', $ids)->delete();
    }
}