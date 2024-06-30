<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = ['manpower_id', 'title', 'description', 'tanggal_training'];

    public function manpower()
    {
        return $this->belongsTo(Manpower::class);
    }
}
