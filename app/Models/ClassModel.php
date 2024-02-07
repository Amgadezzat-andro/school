<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'class';

    public static function getClasses()
    {
        DB::enableQueryLog();

        $return = self::select('class.*', 'users.name as created_by')
            ->join('users', 'users.id', 'class.created_by')
            ->where('class.is_delete', '=', 0);

        if (!empty(Request::get('name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('status'))) {
            $return = $return->where('class.status', '=', Request::get('status'));
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('class.created_at', '=', Request::get('date'));
        }

        $return = $return->orderBy('class.id')
            ->paginate(5);
        // dd(DB::getQueryLog());
        return $return;
    }
    public static function getClassByID($classID)
    {
        return ClassModel::where('id', '=', $classID)->first();
    }
    public static function getClass()
    {
        DB::enableQueryLog();

        $return = self::select('class.*')
            ->join('users', 'users.id', 'class.created_by')
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 1)
            ->orderBy('class.name', 'asc')
            ->get();
        // dd(DB::getQueryLog());
        return $return;
    }
}
