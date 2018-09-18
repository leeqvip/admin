<?php
namespace techadmin\model;

use think\model\Pivot;

/**
 *
 */
class AdminerRole extends Pivot
{
    use traits\ModelHelper;

    protected $table = 'techadmin_adminers_roles';

}
