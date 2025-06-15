<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Các thuộc tính có thể gán hàng loạt.
     *
     * @var array<int, string>
     */
    protected $fillable = ['username', 'email', 'password', 'role'];

    /**
     * Các thuộc tính bị ẩn khi trả về dạng mảng hoặc JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Các thuộc tính cần ép kiểu.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
