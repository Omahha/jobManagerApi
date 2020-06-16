<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = [
        'name', 'address', 'logo'
    ];

    public function logo() {
        return $this->morphOne(Photo::class, 'photoable');
    }

    public function actions() {
        return $this->hasMany(Action::class);
    }
}
