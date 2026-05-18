<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;
    
    public function advertisement(){
        return $this->hasOne(Advertisement::class);
    }
}
