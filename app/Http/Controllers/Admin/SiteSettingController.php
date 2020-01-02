<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{

    public function set(Request $request)
    {
        $setting = Setting::first(); // 获取setting数据表中一条数据

        if ($request->isXmlHttpRequest()) { // 只处理ajax提交的，其他不处理

            if (!empty($setting->id)) { // 如果数据存在，更新数据
                Setting::edit($setting, $request->all());
            } else { // 如果数据表中没有任何数据，则添加一条数据
                Setting::add($request->all());
            }

            // 继承父类Controller的response属性
            $this->response->setMsg(200, '成功');
            return $this->response->responseJSON();

        }


        // 把从数据库读出的数据传给视图
        $data['data'] = $setting;
        return view('admin.siteSetting', $data);
    }
}