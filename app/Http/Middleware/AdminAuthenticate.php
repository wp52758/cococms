<?php

namespace App\Http\Middleware;

use App\Admin;
use Closure;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class AdminAuthenticate
{

    public function handle($request, Closure $next, $guard = 'admin')
    {

        try{

            // 在登录的时候，把用户的ID进行加密后放到cookie中。这里是验证，取出coolie解密。如果解密失败，会抛出异常
            $adminId = Crypt::decrypt($_COOKIE['user_id']);

            $adminInfo = \App\Models\Admin::find($adminId);

            // 检查用户是否存在
            if(empty($adminInfo->id)){
                Throw new \Exception('账号错误');
            }

            // 检查启用状态
            if($adminInfo->state != 1){
                Throw new \Exception('请联系管理员');
            }

        }catch (DecryptException $e){

            // 出错后，可以跳转到错误页面，也可直接返回错误信息

            $arrayResult['code'] = 401;
            $arrayResult['message'] = $e->getMessage();
            $arrayResult['data'] = [];

            return response()->json($arrayResult, 401)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        // $next不能少
        return $next($request);
    }
}
