<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = ['manpower_id', 'title', 'description', 'certificate'];

    public function manpower()
    {
        return $this->belongsTo(Manpower::class);
    }
}



