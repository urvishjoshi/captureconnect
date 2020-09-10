<?php

namespace App\Model;

use App\Model\Capturer;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    public function owner()
    {
    	return $this->belongsTo(Capturer::class);
    }
}
