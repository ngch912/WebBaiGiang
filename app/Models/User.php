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

    /**
     * Quan hệ với bảng CourseMember (Học viên tham gia khóa học).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courseMembers()
    {
        return $this->belongsToMany(Course::class, 'course_members', 'student_id', 'course_id')
                    ->withPivot('status');  // Trả về trạng thái học viên
    }

    /**
     * Quan hệ với bảng Course (Khóa học mà học viên tham gia).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
{
    return $this->belongsToMany(Course::class, 'course_members', 'student_id', 'course_id')->withPivot('status');
}


    /**
     * Quan hệ với bảng Course (Khóa học mà giảng viên tạo).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function createdCourses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }
}
