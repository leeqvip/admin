<?php
namespace techadmin\model;

/**
 *
 */
class Single extends Model
{
    protected $table = 'techadmin_single';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
