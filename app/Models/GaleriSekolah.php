<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriSekolah extends Model
{
    use HasFactory;

    protected $table = 'galeris';
    protected $fillable = [
        'image_path',
    ];
}
