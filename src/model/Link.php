<?php
namespace techadmin\model;

/**
 *
 */
class Link extends Model
{
    protected $table = 'techadmin_links';

    public function linkBlock()
    {
        return $this->belongsTo(LinkBlock::class, 'block', 'block');
    }
}
