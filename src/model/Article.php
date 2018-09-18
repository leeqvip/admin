<?php
namespace techadmin\model;

/**
 *
 */
class Article extends Model
{
    protected $table = 'techadmin_articles';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
