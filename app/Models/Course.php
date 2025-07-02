<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Lecture;
use App\Models\Document;

class Course extends Model
{
    protected $fillable = ['teacher_id', 'name', 'description','subject'];

    /**
     * 👨‍🏫 Khóa học thuộc về một giáo viên
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * 👩‍🎓 Học viên đã được duyệt trong khóa học
     */
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_members', 'course_id', 'student_id')
                    ->withPivot('status', 'joined_at')
                    ->wherePivot('status', 'approved');
    }

    /**
     * 🕒 Học viên đang chờ duyệt
     */
    public function studentsPending()
    {
        return $this->belongsToMany(User::class, 'course_members', 'course_id', 'student_id')
                    ->withPivot('status', 'joined_at')
                    ->wherePivot('status', 'pending');
    }

    /**
     * 🎥 Danh sách bài giảng thuộc khóa học
     */
    public function lectures()
    {
        return $this->hasMany(Lecture::class, 'course_id');
    }

    /**
     * 📎 Danh sách tài liệu (document) thuộc khóa học
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    public function subject() {
    return $this->belongsTo(Subject::class);
}
}
