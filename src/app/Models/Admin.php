<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function admin_shop()
    {
        return $this->hasMany(Admin_shop::class);
    }

}
class Admin extends Authenticatable
{
    // 管理者の認証を確認するメソッド
    public static function check()
    {
        return Auth::guard('admin')->check();
    }
}