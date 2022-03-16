<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activity extends Model
{
    use HasFactory;

    public function activity_times()
    {
        return  $this->hasMany(ActivityTime::class);
    }
}
