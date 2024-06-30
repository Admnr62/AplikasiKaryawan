<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Manpower extends Model
{
    use HasFactory;
    use Searchable;

    protected  $table = '_manpower';
    protected $fillable = [
        'nama', 'badge_number', 'no_register', 'area_kerja', 'customer', 'departemen',
        'jabatan', 'masa_berlaku_permit', 'tipe_permit', 'gender', 'permit_status', 'image', 'barcode'
    ];

    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }

    // Manpower.php
public function training()
{
    return $this->hasMany(Training::class);
}


    // Opsional: tentukan kolom yang akan diindeks ke Algolia
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // tambahkan kolom yang ingin diindeks di sini
        return $array;
    }
}
