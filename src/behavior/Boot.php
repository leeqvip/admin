<?php
namespace techadmin\behavior;

use think\App;
use think\Container;
use think\facade\Route;

/**
 * Tech Admin 启动行为
 */
class Boot
{
    /**
     *
     * @var App
     */
    protected $app;

    /**
     * 路由分组名
     * @var string
     */
    protected $name = 'admin';

    /**
     * 控制器命名空间
     * @var string
     */
    protected $namespace = '\\techadmin\\controller\\';

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function run(App $app)
    {
        $this->loadHelper();
        $this->loadConfig();
        $this->importMiddleware();
        $this->bindProviders();
        $this->bootRoute();
    }

    protected function loadHelper()
    {
        // 加载公共文件
        if (is_file(dirname(dirname(__DIR__)) . '/helper.php')) {
            include_once dirname(dirname(__DIR__)) . '/helper.php';
        }
    }

    protected function loadConfig()
    {
        if (is_file(admin_config_path('filesystems.php'))) {
            $filesystems = require_once admin_config_path('/filesystems.php');
            $config      = Container::get('config');
            $paginate    = $config->pull('filesystems');
            $config->set(array_merge(
                is_array($paginate) ? $paginate : [],
                $filesystems
            ), 'filesystems');
        }
    }

    protected function importMiddleware()
    {

        if (is_file(admin_config_path('middleware.php'))) {
            $middleware = require_once admin_config_path('/middleware.php');
            if (is_array($middleware)) {
                $this->app->middleware->setConfig($middleware);
            }
        }
    }

    protected function bindProviders()
    {
        if (is_file(admin_config_path('provider.php'))) {
            $this->app->bindTo(
                include_once admin_config_path('/provider.php')
            );
        }
    }

    protected function bootRoute()
    {
        $routePath = admin_route_path();
        // 路由检测
        $files = scandir($routePath);
        foreach ($files as $file) {
            if (strpos($file, '.php')) {
                $filename = $routePath . $file;
                // 导入路由配置
                Route::group($this->name, function () use ($filename) {
                    $rules = include_once $filename;
                    if (is_array($rules)) {
                        $this->app->route->import($rules);
                    }
                })->prefix($this->namespace);
            }
        }
    }
}
