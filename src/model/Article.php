<?php
namespace techadmin\model;

/**
 *
 */
class Article extends Model
{
    protected $table = 'techadmin_articles';

    protected $append = ['summary_text'];

    public function getSummaryTextAttr()
    {
        $summary = $this->getAttr('summary');
        if (empty($summary)) {
            $summary = strip_tags($this->getAttr('content'));
        }
        return $summary;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, ArticleTag::class, 'tag_id', 'article_id');
    }
}
