<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    // Bảng lectures
    protected $table = 'lectures';

    // Các trường có thể gán
    protected $fillable = ['course_id', 'title', 'content'];

    // Quan hệ với khóa học
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
