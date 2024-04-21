<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    Protected $fillable = [
        'name'
    ];

    public function shops()
    {
        return $this->hasMany(Shop::class, 'area_id');
    }
}
