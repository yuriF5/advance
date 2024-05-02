<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    public function admin()
    {
        return $this->belongTo(Admin::class);
    }

    public function shop()
    {
        return $this->belongTo(Shop::class);
    }
}
