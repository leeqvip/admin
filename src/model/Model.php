<?php
namespace techadmin\model;

/**
 *
 */
class Model extends \think\Model
{
    use traits\ModelHelper;

    protected $autoWriteTimestamp = 'timestamp';

    protected $createTime = 'created_at';

    protected $updateTime = 'updated_at';
}
