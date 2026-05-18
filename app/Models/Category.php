<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;
    
    public function advertisments(){
        return $this->hasMany(Category::class);
    }
}
