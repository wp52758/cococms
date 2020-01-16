<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/1/9
 * Time: 17:53
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Admin extends Model
{

    // 管理员和角色是多对多关系
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'admin_roles', 'admin_id', 'role_id');
    }

    public static function add(array $adminData, array $roleData)
    {

        try {

            DB::transaction(function () use ($adminData, $roleData) {
                // 保存管理员信息
                $admin = new Admin();
                $admin->user_name = $adminData['user_name'];
                $admin->password = password_hash($adminData['password'], PASSWORD_BCRYPT); // 生成密码，不能明文保存
                $admin->email = $adminData['email'];
                $admin->state = (int)$adminData['state'];
                $admin->save();

                // 使用attach保存管理员和角色关系信息
                $admin->roles()->attach(array_values($roleData));
            });

        } catch (\Exception $e) {
            Log::error('添加管理员信息失败，失败信息：' . $e->getMessage());
            return false;
        }

        return true;

    }

    public static function edit(Admin $admin, array $adminData, array $roleData)
    {
        try {

            DB::transaction(function () use ($admin, $adminData, $roleData) {

                // 编辑使用sync()，使用其它的不行，attach是添加，detach是删除。
                $admin->roles()->sync(array_values($roleData));

                // 更新管理员数据
                !empty($adminData['user_name']) && $admin->user_name = $adminData['user_name'];
                !empty($adminData['password']) && $admin->password = password_hash($adminData['password'], PASSWORD_BCRYPT); // 生成密码，不能明文保存
                !empty($adminData['email']) && $admin->email = $adminData['email'];
                $admin->state = (int)$adminData['state'];
                $admin->update();

            });


        } catch (\Exception $e) {
            Log::error('编辑管理员信息失败，失败信息：' . $e->getMessage());
            return false;
        }

        return true;

    }


    public static function lists(array $conditions, $page = 0, $perPage = 15)
    {
        $article = Admin::with('roles');

        !empty($conditions['title']) && $article->where('title', 'like', "{$conditions['title']}%"); // 模糊匹配标题查询
        $article->orderBy('id', 'DESC');

        return $article->paginate($perPage, ['*'], 'page', $page);
    }

    public static function del(Admin $admin)
    {
        $admin->delete();
        $admin->roles()->detach();
    }

}