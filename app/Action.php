<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    //
    protected $fillable = [
        'title', 'user_id', 'company_id', 'status', 'place', 'scheduleFrom', 'scheduleTo', 'color'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
