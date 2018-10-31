<?php

namespace techadmin\model;

class Single extends Model
{
    protected $table = 'techadmin_single';

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
}
