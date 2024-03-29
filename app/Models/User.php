<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static public function getEmailSingle($email)
    {
        return User::where('email', '=', $email)->first();

    }
    static public function getTokenSingle($remember_token)
    {
        return User::where('remember_token', '=', $remember_token)->first();
    }

    static public function getAdmin()
    {
        $return = self::select('users.*')
            ->where('user_type', '=', 1)
            ->where('is_delete', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('created_at', '=', Request::get('date'));
        }
        $return = $return->orderBy('id', 'desc')
            ->paginate(5);

        return $return;
    }
    static public function getStudents()
    {
        $return = self::select('users.*', 'class.name as class_name', 'parents.name as parent_name', 'parents.last_name as parent_last_name')
            ->leftJoin('users as parents', 'parents.id', '=', 'users.parent_id')
            ->leftJoin('class', 'class.id', 'users.class_id')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0);
        // Filters
        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('last_name'))) {
            $return = $return->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('admission_number'))) {
            $return = $return->where('users.admission_number', 'like', '%' . Request::get('admission_number') . '%');
        }
        if (!empty(Request::get('roll_number'))) {
            $return = $return->where('users.roll_number', 'like', '%' . Request::get('roll_number') . '%');
        }
        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('users.gender', '=', Request::get('gender'));
        }
        if (!empty(Request::get('caste'))) {
            $return = $return->where('users.caste', 'like', '%' . Request::get('caste') . '%');
        }
        if (!empty(Request::get('religion'))) {
            $return = $return->where('users.religion', 'like', '%' . Request::get('religion') . '%');
        }
        if (!empty(Request::get('mobile_number'))) {
            $return = $return->where('users.mobile_number', 'like', '%' . Request::get('mobile_number') . '%');
        }
        if (!empty(Request::get('blood_group'))) {
            $return = $return->where('users.blood_group', 'like', '%' . Request::get('blood_group') . '%');
        }
        if (!empty(Request::get('status'))) {
            $return = $return->where('users.status', '=', Request::get('status'));
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('users.created_at', '=', Request::get('date'));
        }
        if (!empty(Request::get('date_of_birth'))) {
            $return = $return->whereDate('users.date_of_birth', '=', Request::get('date_of_birth'));
        }
        if (!empty(Request::get('admission_date'))) {
            $return = $return->whereDate('users.admission_date', '=', Request::get('admission_date'));
        }


        $return = $return->orderBy('users.id', 'desc')
            ->paginate(20);

        return $return;
    }
    static public function getTeachers()
    {
        $return = self::select('users.*')
            ->where('users.user_type', '=', 2)
            ->where('users.is_delete', '=', 0);
        // Filters
        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('last_name'))) {
            $return = $return->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('users.gender', '=', Request::get('gender'));
        }
        if (!empty(Request::get('mobile_number'))) {
            $return = $return->where('users.mobile_number', 'like', '%' . Request::get('mobile_number') . '%');
        }
        if (!empty(Request::get('martial_status'))) {
            $return = $return->where('users.martial_status', 'like', '%' . Request::get('martial_status') . '%');
        }
        if (!empty(Request::get('current_address'))) {
            $return = $return->where('users.current_address', 'like', '%' . Request::get('current_address') . '%');
        }
        if (!empty(Request::get('date_of_join'))) {
            $return = $return->whereDate('users.date_of_join', '=', Request::get('date_of_join'));
        }
        if (!empty(Request::get('status'))) {
            $return = $return->where('users.status', '=', Request::get('status'));
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('users.created_at', '=', Request::get('date'));
        }


        $return = $return->orderBy('users.id', 'desc')
            ->paginate(20);

        return $return;
    }
    static public function getOneAdmin($adminID)
    {
        // return self::find($adminID);
        return User::where('id', '=', $adminID)->first();
    }
    static public function getSingle($userID)
    {
        return self::find($userID);
        // return User::where('id', '=', $adminID)->first();
    }
    public function getProfile()
    {
        if (!empty($this->profile_pic) && file_exists('upload/profile/' . $this->profile_pic)) {
            return url('upload/profile/' . $this->profile_pic);
        } else {
            return "";
        }
    }

    static public function getParents()
    {
        $return = self::select('users.*')
            ->where('users.user_type', '=', 4)
            ->where('users.is_delete', '=', 0);
        // Filters
        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('last_name'))) {
            $return = $return->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('users.gender', '=', Request::get('gender'));
        }
        if (!empty(Request::get('occupation'))) {
            $return = $return->where('users.occupation', 'like', '%' . Request::get('occupation') . '%');
        }
        if (!empty(Request::get('address'))) {
            $return = $return->where('users.address', 'like', '%' . Request::get('address') . '%');
        }
        if (!empty(Request::get('mobile_number'))) {
            $return = $return->where('users.mobile_number', 'like', '%' . Request::get('mobile_number') . '%');
        }
        if (!empty(Request::get('status'))) {
            $return = $return->where('users.status', '=', Request::get('status'));
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('users.created_at', '=', Request::get('date'));
        }
        $return = $return->orderBy('users.id', 'desc')
            ->paginate(20);

        return $return;
    }

    static public function getSearchStudents()
    {
        if (!empty(Request::get('id')) || !empty(Request::get('name')) || !empty(Request::get('last_name')) || !empty(Request::get('email'))) {
            $return = self::select('users.*', 'class.name as class_name', 'parents.name as parent_name')
                ->leftJoin('users as parents', 'parents.id', '=', 'users.parent_id')
                ->leftJoin('class', 'class.id', 'users.class_id')
                ->where('users.user_type', '=', 3)
                ->where('users.is_delete', '=', 0);
            // Filters
            if (!empty(Request::get('id'))) {
                $return = $return
                    ->where('users.id', 'like', '%' . Request::get('id') . '%');
            }
            if (!empty(Request::get('name'))) {
                $return = $return
                    ->where('users.name', 'like', '%' . Request::get('name') . '%');
            }
            if (!empty(Request::get('last_name'))) {
                $return = $return
                    ->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
            }
            if (!empty(Request::get('email'))) {
                $return = $return
                    ->where('users.email', 'like', '%' . Request::get('email') . '%');
            }
            $return = $return->orderBy('users.id', 'desc')
                ->limit(50)
                ->get();

            return $return;
        }
    }
    public static function getMyStudents($parentID)
    {
        $return = self::select('users.*', 'class.name as class_name', 'parents.name as parent_name')
            ->leftJoin('users as parents', 'parents.id', '=', 'users.parent_id')
            ->leftJoin('class', 'class.id', 'users.class_id')
            ->where('users.user_type', '=', 3)
            ->where('users.parent_id', '=', $parentID)
            ->where('users.is_delete', '=', 0)
            ->orderBy('users.id', 'desc')
            ->get();

        return $return;

    }
    static public function getTeacherClass()
    {
        $return = self::select('users.*')
            ->where('users.user_type', '=', 2)
            ->where('users.is_delete', '=', 0);

        $return = $return->orderBy('users.id', 'desc')
            ->get();

        return $return;
    }

    static public function getTeacherStudents($teacherID){
        $return = self::select('users.*', 'class.name as class_name')
        ->leftJoin('class', 'class.id', 'users.class_id')
        ->leftJoin('assign_class_teacher','assign_class_teacher.class_id','class.id')
        ->where('assign_class_teacher.teacher_id','=',$teacherID)
        ->where('assign_class_teacher.status', '=', 1)
        ->where('assign_class_teacher.is_delete', '=', 0)
        ->where('users.user_type', '=', 3)
        ->where('users.is_delete', '=', 0)
        ->orderBy('users.id', 'desc')
        ->groupBy('users.id')
        ->paginate(20);

    return $return;
    }

}
