<?php

namespace App\Http\Controllers;

use App\Services\Response;
use Illuminate\Support\Facades\Crypt;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    protected $response;

    protected $userId = 0;

    public function __construct()
    {
        $this->response = new Response();
        !empty($_COOKIE['user_id']) && $this->userId = Crypt::decrypt($_COOKIE['user_id']);
    }
}
