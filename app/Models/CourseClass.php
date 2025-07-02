<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseClass extends Model
{
    use HasFactory;

    protected $table = 'course_classes';

    protected $fillable = [
        'name',
        'course_id',
        'teacher_id',
        'semester',
        'year',
    ];

    // Quan hệ với khóa học
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Quan hệ với giáo viên
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Quan hệ với sinh viên qua bảng trung gian
    public function students()
    {
        return $this->belongsToMany(User::class, 'class_members', 'class_id', 'student_id');
    }
}
