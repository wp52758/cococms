<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019/12/26
 * Time: 11:30
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {


        return view('admin/index');
    }
}