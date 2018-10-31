<?php

namespace techadmin\model;

class Advertising extends Model
{
    protected $table = 'techadmin_advertisings';

    public function advertisingBlock()
    {
        return $this->belongsTo(AdvertisingBlock::class, 'block', 'block');
    }
}
