<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/1/3
 * Time: 12:43
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function lists(Request $request)
    {

        $list = Message::lists($request->input('page', 0));

        $data['list'] = $list;
        return view('admin.message.list', $data);
    }
}