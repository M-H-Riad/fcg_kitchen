<?php

namespace Modules\Course\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignCourse extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'assign_courses';

    public function courseData()
    {
        return $this->belongsTo(CourseModel::class, 'course_id', 'id');
    }

    public function studentData()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
}
