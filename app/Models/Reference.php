<?php

namespace App\Models;

use App\Enums\HardnessDegree;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;
    protected $casts = [
        'hardness-degree' => HardnessDegree::class
    ];
    public function Study(){
        return $this->hasMany(Study::class);
    }
    public function Chapter(){
        return $this->hasMany(Refrence::class);
    }

}
