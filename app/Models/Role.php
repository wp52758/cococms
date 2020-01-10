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

class Role extends Model
{
    public static function add(array $roleData, array $permissionData)
    {

        try {
            DB::transaction(function () use ($roleData, $permissionData) {

                // 保存角色信息
                $role = new Role();
                $role->role_name = $roleData['role_name'];
                $role->save();

                // 保存角色权限关系信息，批量插入
                $rolePermissionData = [];
                foreach ($permissionData as $permissionDatum) {
                    $rolePermissionData[] = [
                        'role_id' => $role->id,
                        'permission_id' => $permissionDatum,
                    ];
                }
                Permission::create($rolePermissionData);
            });
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    public static function lists()
    {
        return Role::get();
    }
}