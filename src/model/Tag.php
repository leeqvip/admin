<?php
namespace techadmin\model;

/**
 *
 */
class Tag extends Model
{
    protected $table = 'techadmin_tags';

    public function articles()
    {
        return $this->belongsToMany(Article::class, ArticleTag::class, 'article_id', 'tag_id');
    }
}
