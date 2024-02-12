<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ClassSubjectModel extends Model
{
    use HasFactory;
    protected $table = 'class_subject';

    public static function getAssignedSubjects()
    {
        $return = self::select('class_subject.*', 'users.name as created_by', 'class.name as class_name', 'subject.name as subject_name')
            ->join('users', 'users.id', 'class_subject.created_by')
            ->join('class', 'class.id', 'class_subject.class_id')
            ->join('subject', 'subject.id', 'class_subject.subject_id')
            ->where('class_subject.is_delete', '=', 0);

        if (!empty(Request::get('subject_name'))) {
            $return = $return->where('subject.name', 'like', '%' . Request::get('subject_name') . '%');
        }
        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('status'))) {
            $return = $return->where('class_subject.status', '=', Request::get('status'));
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('class_subject.created_at', '=', Request::get('date'));
        }

        $return = $return->orderBy('class_subject.id')
            ->paginate(20);
        // dd(DB::getQueryLog());
        return $return;
    }

    public static function countAlready($class_id, $subject_id)
    {
        return self::where('class_id', '=', $class_id)
            ->where('subject_id', '=', $subject_id)->first();

    }
    public static function getAssingedSubjectByID($assingedSubjectID)
    {
        return self::where('id', '=', $assingedSubjectID)->first();
    }
    public static function getAssignedSubjectsByClassID($classID)
    {
        return self::where('class_id', '=', $classID)->where('is_delete', '=', 0)->get();
    }

    public static function deleteSubject($classID)
    {
        return self::where('class_id', '=', $classID)->delete();
    }
    public static function getMySubjects($classID)
    {
        $return = self::select('class_subject.*', 'subject.name as subject_name')
            ->join('users', 'users.id', 'class_subject.created_by')
            ->join('class', 'class.id', 'class_subject.class_id')
            ->join('subject', 'subject.id', 'class_subject.subject_id')
            ->where('class_subject.class_id','=',$classID)
            ->where('class_subject.is_delete', '=', 0)
            ->where('class_subject.status', '=', 1)
            ->orderBy('class_subject.id','desc')
            ->get();
        // dd(DB::getQueryLog());
        return $return;
    }
}
