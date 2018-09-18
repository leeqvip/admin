<?php
namespace techadmin\support;

use techadmin\model\Menu;
use think\Container;
use think\Controller;
use think\facade\Config;

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
            $config        = Container::get('config');
            $paginate      = $config->pull('paginate');
            $config->set(array_merge(
                is_array($paginate) ? $paginate : [],
                $paginateAdmin
            ), 'paginate');
        }
    }

    public function setViewPath()
    {
        $this->viewPath = admin_view_path();
        $this->view->config('view_path', $this->viewPath);
        $this->view->config('tpl_replace_string', [
            '__TECHADMIN_ASSETS__' => '/vendor/techadmin/assets',
        ]);
    }

    public function assignCommon()
    {
        $menus = app(Menu::class)->toTree();
        $this->view->assign([
            'menus' => $menus,
        ]);
    }
}
