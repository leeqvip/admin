<?php

namespace techadmin\model;

use think\Model as Base;
use Db;

abstract class Model extends Base
{
    public function __construct($data = [])
    {
        parent::__construct($data);
        //TODO:初始化内容
        if ($this->table) {
            $this->table = Db::getConfig('prefix').$this->table;
        }
    }
}
