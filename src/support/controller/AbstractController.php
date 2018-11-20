<?php

namespace techadmin\support\controller;

use techadmin\model\Menu;
use techadmin\service\auth\facade\Auth;
use think\Container;
use think\Controller;
use think\facade\Config;
use think\Console;
use think\Loader;

abstract class AbstractController extends Controller
{
    protected $viewPath = '';

    public function __construct()
    {
        parent::__construct();

        $this->initConfig();

        $this->setViewPath();

        $this->assignCommon();
    }

    public function initConfig()
    {
        if (is_file(admin_config_path('paginate.php'))) {
            $paginateAdmin = include admin_config_path('paginate.php');
            $config = Container::get('config');
            $paginate = $config->pull('paginate');
            $config->set(array_merge(
                \is_array($paginate) ? $paginate : [],
                $paginateAdmin
            ), 'paginate');
        }
    }

    public function setViewPath()
    {
        $this->viewPath = config('techadmin.template.view_path');
        $this->view->config('view_path', $this->viewPath);
        $this->view->config('tpl_replace_string', config('techadmin.template.tpl_replace_string'));
        $assets = config('techadmin.template.tpl_replace_string.__TECHADMIN_ASSETS__');
        if (!file_exists(Loader::getRootPath().ltrim($assets, '/'))) {
            throw new \Exception('Resource not published,Please initialize TechAdmin.');
            // Console::call('techadmin:init');
        }
    }

    public function assignCommon()
    {
        $menus = app(Menu::class)->toTree();
        $adminer = Auth::user();
        $this->view->assign(compact('menus', 'adminer'));
    }
}
