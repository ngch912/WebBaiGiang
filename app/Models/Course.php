<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['teacher_id', 'title', 'description'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
