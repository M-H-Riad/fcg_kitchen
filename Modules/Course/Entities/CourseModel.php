<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseModel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sessionData()
    {
        return $this->belongsTo(Session::class, 'session_id', 'id');
    }
}
