<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019/12/26
 * Time: 11:30
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Menu;
use App\Models\Permission;

class IndexController extends Controller
{
    public function index()
    {

        $data['menus'] = Menu::lists();
        $menus = Admin::menuPermissions($this->userId);
//        dump($data['menus']->toArray());
//dd($menus);
        $admin = Admin::find($this->userId);

        $menusId = [];

        if ($admin['user_name'] == SUPER_ADMINISTRATOR) {

            $permissions = Permission::with('menu')->where('is_menu', 1)->get();
//dd($permissions->toArray());
            foreach ($permissions as $permission) {
                $menusId[$permission['menu_id']] = $permission['path'];
            }


        } else {
            foreach ($menus as $key => $path) {
                $menusId[$key] = $path;
            }
        }



        $data['menusId'] = $menusId;

        return view('admin/index', $data);
    }
}