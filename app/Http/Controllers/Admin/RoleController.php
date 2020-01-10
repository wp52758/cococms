<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/1/10
 * Time: 16:22
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function lists()
    {

        $data['role'] = Role::lists();
        return view('admin.role.list', $data);
    }

    public function add(Request $request)
    {


        $data['menus'] = Menu::lists(); // 根据菜单查找权限
        return view('admin.role.add', $data);
    }

}