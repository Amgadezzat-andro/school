<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectTimeTableModel extends Model
{
    use HasFactory;
    protected $table = 'class_subject_timetable';

    static public function getRecord($ClassID, $SubjectID, $WeekID)
    {
        return self::where('class_id', '=', $ClassID)
            ->where('subject_id', '=', $SubjectID)
            ->where('week_id', '=', $WeekID)
            ->first();
    }
}
