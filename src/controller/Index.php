<?php
namespace techadmin\controller;

use techadmin\model\Menu;
// use techadmin\service\auth\facade\Auth;
use techadmin\support\AbstractController;
use think\Controller;

class Index extends AbstractController
{
    protected $menu;

    public function __construct(Menu $menu)
    {
        parent::__construct();
        $this->menu = $menu;
    }

    public function index()
    {
        // dump(Auth::guard()->user());die;
        return $this->fetch('index/index', [

        ]);
    }
}
