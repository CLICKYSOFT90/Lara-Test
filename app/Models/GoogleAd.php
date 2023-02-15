<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class GoogleAd extends Model
{
    use HasFactory;

    function getDayAttribute($timestamp) {
        return (new Carbon($timestamp))->format('d-M-Y h:i A');
    }
}
