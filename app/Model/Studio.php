<?php

namespace App\Model;

use App\Model\Capturer;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
	protected $fillable = ['owner_id','studio_name','studio_banner','studio_address','studio_lat','studio_lng'];
	
    public function owner()
    {
    	return $this->belongsTo(Capturer::class);
    }
    public function getOwner()
    {
        return $owner = $this->owner['name'];
    }
}
