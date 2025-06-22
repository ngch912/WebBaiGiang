<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lecture;
use App\Models\User;

class Course extends Model
{
    protected $fillable = ['teacher_id', 'name', 'description'];  // Đổi title thành name để phù hợp với cơ sở dữ liệu

    /**
     * Quan hệ với giáo viên (Giảng viên dạy khóa học)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Quan hệ với học viên (Học viên tham gia khóa học)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_members', 'course_id', 'student_id')->withPivot('status');
    }

    /**
     * Quan hệ với bài giảng (Bài giảng trong khóa học)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lectures()
    {
        return $this->hasMany(Lecture::class, 'course_id');
    }
}
