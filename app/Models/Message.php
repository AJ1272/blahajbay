<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable =[
        'content',
        'messagechain_id',
        'user_id',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function advertisement(){
        return $this->belongsTo(Advertisement::class);
    }

    public function messagechain(){
        return $this->belongsTo(Messagechain::class);
    }
}
