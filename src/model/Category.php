<?php
namespace techadmin\model;

/**
 *
 */
class Category extends Model
{
    use traits\Tree;

    protected $table = 'techadmin_categorys';

    /**
     * 数据输出需要追加的属性
     * @var array
     */
    protected $append = ['type_text'];

    public function getTypeTextAttr()
    {
        return self::mapType($this->getAttr('type'));
    }

    public static function mapType($type = null)
    {
        $map = [
            'list'     => '列表',
            'list-img' => '图文',
            'single'   => '单页',
            'topic'    => '专题',
        ];
        if (is_null($type)) {
            return $map;
        }
        return isset($map[$type]) ? $map[$type] : '';
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }
}
