<?php
namespace techadmin\middleware;

use techadmin\service\auth\facade\Auth;
use think\model\Collection;

/**
 *
 */
class PermissionCheck
{
    protected $request;

    public function handle($request, \Closure $next)
    {
        $this->request = $request;

        if (!$adminer = Auth::user()) {
            return $next($request);
        }

        if ($this->shouldPassThrough()) {
            return $next($request);
        }

        $allPermissions = $adminer->roles()->with('permissions')->select()->column('permissions');

        foreach ($allPermissions as $key => $permission) {
            if (isset($permissions)) {
                $permissions = $permission->merge($permissions);
            } else {
                $permissions = $permission;
            }
        }

        if (!$this->permissionCheck($permissions)) {
            throw new \Exception("权限不足");
        }

        return $next($request);
    }

    public function permissionCheck($permission)
    {
        if ($permission instanceof Collection) {
            foreach ($permission as $key => $permission) {
                if ($this->permissionCheck($permission)) {
                    return true;
                }
            }
        }
        $currentPath = $this->parseCurrentPath();

        $httpPaths = $this->parseHttpPath($permission->http_path);

        foreach ($httpPaths as $httpPath) {
            if ($this->checkHttpPath($httpPath, $currentPath)) {
                return true;
            }
        }
        return false;

    }

    protected function checkHttpPath($httpPath, $currentPath)
    {

        if (!$this->endsWith($httpPath, '*')) {
            if ($httpPath == $currentPath) {
                return true;
            }
        } else {
            if ($this->startsWith($currentPath, rtrim(rtrim($httpPath, '*'), '/'))) {
                return true;
            }
        }
        return false;
    }

    public function shouldPassThrough()
    {
        $excepts = [
            '/',
            '',
            'dashboard',
        ];

        foreach ($excepts as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }
            if ($except == $this->parseCurrentPath()) {
                return true;
            }
        }

        return false;
    }

    public function parseCurrentPath()
    {
        $currentPath = ltrim(trim($this->request->path(), '/'), 'admin');
        if ($currentPath !== '/') {
            $currentPath = trim($currentPath, '/');
        }
        return $currentPath;
    }

    public function parseHttpPath($httpPath)
    {
        return array_map(function ($row) {
            return trim(trim($row), '/');
        }, explode(PHP_EOL, $httpPath));
    }

    public function startsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle !== '' && substr($haystack, 0, strlen($needle)) === (string) $needle) {
                return true;
            }
        }

        return false;
    }

    public static function endsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if (substr($haystack, -strlen($needle)) === (string) $needle) {
                return true;
            }
        }

        return false;
    }
}
