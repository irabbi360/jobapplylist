<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'user_id','title', 'apply_date', 'info',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
