<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->hasOne(Category::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function bids(){
        return $this->hasMany(Bid::class);
    }

    public function advertisementpictures(){
        return $this->hasMany(AdvertisementPicture::class);
    }

    public function sale(){
        return $this->belongsTo(Sale::class);
    }
}
