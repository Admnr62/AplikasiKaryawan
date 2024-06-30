<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class areakerja extends Model
{
    use HasFactory;
    protected $table = 'areakerjas';
    protected $fillable = ['area_kerja'];
}
