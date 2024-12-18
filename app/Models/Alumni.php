<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_lengkap', 'angkatan', 'jurusan_id', 'nomor_hp', 'instagram', 'linkedin', 'facebook', 'photo', 'status'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
