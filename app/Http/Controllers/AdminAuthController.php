<?php


namespace App\Http\Controllers;


use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Tymon\JWTAuth\JWTAuth;

class AdminAuthController extends Controller
{


    public function login(Request $request)
    {
        // 验证提交的数据
        $this->validate($request, [
            'user_name' => 'required|string|max:20|min:2',
            'password' => 'required|string|max:16|min:6',
            'vercode' => 'required|max:4|min:4',
        ]);

        // 接收提交的数据
        $userName = $request->input('user_name');
        $password = $request->input('password');
        $vercode = $request->input('vercode');

        // 取出服务器端保存的验证码
        $captchaCode = $_COOKIE['captcha'] ?? '';

        // 验证验证码是否一致，不一致直接返回错误
        if (app('captcha')->check($vercode, $captchaCode) === false) {
            $this->response->setMsg(400, '验证码错误');
            return $this->response->responseJSON();
        }

        // 验证码使用完后，消除cookie，为了安全
        setcookie('captcha',$vercode,time() - 10);

        $admin = Admin::where('user_name', $userName)->first();

        // 如果用户名不存在，直接返回错误
        if (empty($admin->id)) {
            $this->response->setMsg(400, '账号或者密码错误');
            return $this->response->responseJSON();
        }

        // 检查密码是否一致，不一致的话，返回错误
        if (!password_verify($password, $admin->password)) {
            $this->response->setMsg(400, '账号或者密码错误');
            return $this->response->responseJSON();
        }

        // 账号未启用，不能登录
        if ($admin->state != 1) {
            $this->response->setMsg(-1, '错误！请联系管理员');
            return $this->response->responseJSON();
        }



        setcookie('user_id',Crypt::encrypt($admin->id), time() + 36000);

        return $this->response->responseJSON();


    }

    public function logout(Request $request)
    {

        $this->jwt->parseToken()->invalidate();

        return $this->response->responseJSON();

    }

    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->jwt->factory()->getTTL(),
        ];
    }
}