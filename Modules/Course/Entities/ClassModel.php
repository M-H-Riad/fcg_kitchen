<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassModel extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'class_models';

    public function courseData()
    {
        return $this->belongsTo(CourseModel::class, 'course_id', 'id');
    }
}
