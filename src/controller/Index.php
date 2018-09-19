<?php
namespace techadmin\controller;

use techadmin\service\auth\facade\Auth;
use techadmin\support\AbstractController;
use think\Controller;

class Index extends AbstractController
{
    protected $menu;

    public function index()
    {
        $adminer = Auth::user();
        return $this->fetch('index/index', [
            'adminer' => $adminer,
        ]);
    }
}
