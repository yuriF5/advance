<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopRepresentative extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'shop_id',
    ];

    public function shop()
    {
        return $this->belongsTo('App\Models\Shop', 'shop_id');
    }

}
