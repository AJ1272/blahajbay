<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdvertisementPicture extends Model
{
    use HasFactory;
    
    public function advertisement(){
        return $this->belongsTo(Advertisement::class);
    }
}
