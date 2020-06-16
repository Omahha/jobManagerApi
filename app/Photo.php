<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $imagesPath = '/images/';

    protected $fillable = [
        'path', 'photoable_id', 'photoable_type'
    ];

    public function photoable() {
        return $this->morphTo();
    }

    public function getPathAttribute($value) {
        return $this->imagesPath.$value;
    }
}
