<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class AssignClassTeacherModel extends Model
{
    protected $table = 'assign_class_teacher';
    use HasFactory;

    public static function countAlready($class_id, $teacher_id)
    {
        return self::where('class_id', '=', $class_id)
            ->where('teacher_id', '=', $teacher_id)
            ->first();

    }
    public static function getAssignedClasses()
    {
        $return = self::select('assign_class_teacher.*', 'users.name as created_by', 'class.name as class_name', 'teachers.name as teacher_name')
            ->join('users', 'users.id', 'assign_class_teacher.created_by')
            ->join('users as teachers', 'teachers.id', 'assign_class_teacher.teacher_id')
            ->join('class', 'class.id', 'assign_class_teacher.class_id')
            ->where('assign_class_teacher.is_delete', '=', 0);

        if (!empty(Request::get('teacher_name'))) {
            $return = $return->where('teachers.name', 'like', '%' . Request::get('teacher_name') . '%');
        }
        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('status'))) {
            $return = $return->where('assign_class_teacher.status', '=', Request::get('status'));
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('assign_class_teacher.created_at', '=', Request::get('date'));
        }

        $return = $return->orderBy('assign_class_teacher.id')
            ->paginate(20);
        return $return;
    }

    public static function getAssingedTeachertByID($assingedTeacherID)
    {
        return self::where('id', '=', $assingedTeacherID)->first();
    }
    public static function getAssignedTeachersByClassID($classID)
    {
        return self::where('class_id', '=', $classID)->where('is_delete', '=', 0)->get();
    }
    public static function deleteTeachers($classID)
    {
        return self::where('class_id', '=', $classID)->delete();
    }
}
