<?php

namespace techadmin\model;

class Menu extends Model
{
    use traits\Tree;

    protected $table = 'menus';
}
