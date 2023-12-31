<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use HasFactory , SoftDeletes;
    public function Refrence(){
        return $this->belongsTo(Refrence::class);
    }
}
