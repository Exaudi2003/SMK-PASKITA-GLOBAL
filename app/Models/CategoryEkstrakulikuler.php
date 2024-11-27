<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryEkstrakulikuler extends Model
{
    use HasFactory;
    protected $fillable = ['category_name', 'image', 'description'];

        /**
     * Relasi One-to-Many dengan model Ekstrakulikuler.
     */
    public function ekstrakulikulers()
    {
        return $this->hasMany(Ekstrakulikuler::class, 'category_ekstrakulikuler_id', 'id');
    }
}
