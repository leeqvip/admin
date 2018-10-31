<?php
namespace techadmin\service\auth\facade;

use think\Facade;

/**
 *
 */
class Auth extends Facade
{
    protected static function getFacadeClass()
    {
        return \techadmin\service\auth\Auth::class;
    }
}
