<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019/12/30
 * Time: 15:44
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function child()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')
            ->select(['id', 'type', 'parent_id', 'name', 'dir_name', 'pic', 'is_open', 'is_nav', 'sort', 'is_del']);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public static function add(array $data)
    {
        $category = new Category();
        !empty($data['type']) && $category->type = (int)$data['type'];
        !empty($data['parent_id']) && $category->parent_id = (int)$data['parent_id'];
        !empty($data['name']) && $category->name = $data['name'];
        !empty($data['dir_name']) && $category->dir_name = $data['dir_name'];
        !empty($data['pic']) && $category->pic = $data['pic'];
        !empty($data['is_open']) && $category->is_open = $data['is_open'];
        !empty($data['is_nav']) && $category->is_nav = (int)$data['is_nav'];
        !empty($data['sort']) && $category->sort = (int)$data['sort'];
        return $category->save();
    }

    public static function edit(Category $category, array $data)
    {
        !empty($data['type']) && $category->type = (int)$data['type'];
        !empty($data['parent_id']) && $category->parent_id = (int)$data['parent_id'];
        !empty($data['name']) && $category->name = $data['name'];
        !empty($data['dir_name']) && $category->dir_name = $data['dir_name'];
        !empty($data['pic']) && $category->pic = $data['pic'];
        !empty($data['is_open']) && $category->is_open = $data['is_open'];
        !empty($data['is_nav']) && $category->is_nav = (int)$data['is_nav'];
        !empty($data['sort']) && $category->sort = (int)$data['sort'];
        !empty($data['is_del']) && $category->is_del = (int)$data['is_del'];
        return $category->update();

    }

    public static function lists()
    {
        return Category::with('child.child')
            ->select(['id', 'type', 'parent_id', 'name', 'dir_name', 'pic', 'is_nav', 'sort', 'is_del', 'is_open'])
            ->where('parent_id', 0)
            ->where('is_del', 0)
            ->get();
    }

    public static function del(array $ids)
    {

        return Category::whereIn('id', $ids)->update(['is_del' => 1]);
    }

    public static function isOpen(Category $category)
    {
        $category->is_open = !$category->is_open;
        return $category->update();
    }


}