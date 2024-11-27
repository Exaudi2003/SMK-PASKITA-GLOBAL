<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakulikuler extends Model
{
    use HasFactory;
    protected $table = 'ekstrakulikuler';

    protected $fillable = [
        'category_ekstrakulikuler_id',
        'name',
        'description',
        'image',
    ];

    /**
     * Relasi Many-to-One dengan model CategoryEkstrakulikuler.
     */
    public function category()
    {
        return $this->belongsTo(CategoryEkstrakulikuler::class, 'category_ekstrakulikuler_id', 'id');
    }
}
