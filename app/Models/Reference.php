<?php

namespace App\Models;

use App\Enums\HardnessDegree;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reference extends Model
{
    use HasFactory ,SoftDeletes;
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
