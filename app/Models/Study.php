<?php

namespace App\Models;

use App\Enums\StudyTargetType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Study extends Model
{
    use HasFactory,SoftDeletes;
    protected $casts = [
        'target_type' => StudyTargetType::class
    ];
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Refrence(){
        return $this->belongsTo(Refrence::class);
    }
}
