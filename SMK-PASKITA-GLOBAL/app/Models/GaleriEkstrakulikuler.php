<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriEkstrakulikuler extends Model
{
    use HasFactory;

    protected $table = 'galeri_ekstrakulikuler';

    protected $fillable = [
        'ekstrakulikuler_id',
        'path',
    ];

    // Relasi dengan model Ekstrakulikuler
    public function ekstrakulikuler()
    {
        return $this->belongsTo(Ekstrakulikuler::class, 'ekstrakulikuler_id');
    }
}
