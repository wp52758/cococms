<?php

namespace App\Http\Controllers;

use App\Services\Response;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    protected $response;
    public function __construct()
    {
        $this->response = new Response();
    }
}
