<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class SubjectModel extends Model
{
    use HasFactory;
    protected $table = 'subject';
    public static function getSubjects()
    {
        DB::enableQueryLog();

        $return = self::select('subject.*', 'users.name as created_by')
            ->join('users', 'users.id', 'subject.created_by')
            ->where('subject.is_delete', '=', 0);

        if (!empty(Request::get('name'))) {
            $return = $return->where('subject.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('status'))) {
            $return = $return->where('subject.status', '=', Request::get('status'));
        }
        if (!empty(Request::get('type'))) {
            $return = $return->where('subject.type', '=', Request::get('type'));
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('subject.created_at', '=', Request::get('date'));
        }

        $return = $return->orderBy('subject.id')
            ->paginate(5);
        // dd(DB::getQueryLog());
        return $return;
    }
    public static function getSubjectByID($SubjectsID)
    {
        return SubjectModel::where('id', '=', $SubjectsID)->first();
    }
}
