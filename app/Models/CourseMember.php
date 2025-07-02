<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseMember extends Model
{

    
    // Tên bảng tương ứng trong cơ sở dữ liệu
    protected $table = 'course_members';

    // Các trường có thể gán hàng loạt
   protected $fillable = [
        'user_id',
        'student_id',
        'course_id',
        'status',
        'joined_at',
        'role',
    ];

    /**
     * Quan hệ với bảng Course (Khóa học)
     * Một CourseMember thuộc về một Course (khóa học)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Quan hệ với bảng User (Học viên)
     * Một CourseMember thuộc về một User (học viên)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    
}
