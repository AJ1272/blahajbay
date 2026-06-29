<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Messagechain extends Model
{
    use HasFactory;

    protected $fillable =[
        'seller_id',
        'buyer_id',
        'advertisement_id',
    ];
    
    public function seller(){
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function buyer(){
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function advertisement(){
        return $this->belongsTo(Advertisement::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

}
