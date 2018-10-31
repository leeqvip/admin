<?php

namespace techadmin\model;

use think\model\Pivot;

class RolePermission extends Pivot
{
    use traits\ModelHelper;

    protected $table = 'techadmin_roles_permissions';
}
