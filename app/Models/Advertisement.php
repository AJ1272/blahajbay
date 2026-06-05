<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advertisement extends Model
{
    use HasFactory;

    protected $attributes =[
        'status' => 'available',
    ];

    protected $fillable =[
        'user_id',
        'title',
        'description',
        'price',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
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
