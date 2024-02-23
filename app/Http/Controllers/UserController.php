<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function myAccount()
    {
        if (Auth::user()->user_type == 1) {
            $data['admin'] = User::getSingle(Auth::user()->id);
            return view('admin.my_account', $data);
        } elseif (Auth::user()->user_type == 2) {
            $data['teacher'] = User::getSingle(Auth::user()->id);
            return view('teacher.my_account', $data);
        } elseif (Auth::user()->user_type == 3) {
            $data['student'] = User::getSingle(Auth::user()->id);
            return view('student.my_account', $data);
        } elseif (Auth::user()->user_type == 4) {
            $data['parent'] = User::getSingle(Auth::user()->id);
            return view('parent.my_account', $data);
        }

    }
    public function UpdateMyAccount(Request $request)
    {
        $id = Auth::user()->id;
        // ? Backend Validation
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'max:15|min:8',
        ]);

        // ? Update Student
        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);
        if (!empty($request->date_of_birth)) {
            $teacher->date_of_birth = $request->date_of_birth;
        }
        if (!empty($request->date_of_join)) {
            $teacher->date_of_join = $request->date_of_join;
        }
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->martial_status = trim($request->martial_status);
        // If There is a profile pic
        if (!empty($request->file('profile_pic'))) {

            // If There is Image Ater Click Upload Delete It
            if (!empty($teacher->getProfile())) {
                unlink('upload/profile/' . $teacher->profile_pic);
            }
            // Else Create New Image
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);
            $teacher->profile_pic = $filename;
        }
        $teacher->current_address = trim($request->current_address);
        $teacher->permanent_address = trim($request->permanent_address);
        $teacher->qualification = trim($request->qualification);
        $teacher->work_exp = trim($request->work_exp);
        $teacher->email = trim($request->email);
        $teacher->save();
        // dd($request->all());
        return redirect('teacher/account')->with('success', 'My Account Info Successfully Updated');
    }

    public function UpdateMyAccountStudent(Request $request)
    {
        $id = Auth::user()->id;
        // ? Backend Validation
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'height' => 'max:10',
            'weight' => 'max:10',
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:8',
            'caste' => 'max:15',
            'religon' => 'max:50',
            'religion' => 'max:50',

        ]);

        // ? Update Student
        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->gender = trim($request->gender);
        if (!empty($request->date_of_birth)) {
            $student->date_of_birth = $request->date_of_birth;
        }

        // If There is a profile pic
        if (!empty($request->file('profile_pic'))) {

            // If There is Image Ater Click Upload Delete It
            if (!empty($student->getProfile())) {
                unlink('upload/profile/' . $student->profile_pic);
            }
            // Else Create New Image
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);
            $student->profile_pic = $filename;
        }

        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        $student->blood_group = trim($request->blood_group);
        $student->weight = trim($request->weight);
        $student->height = trim($request->height);
        $student->email = trim($request->email);
        $student->save();

        // dd($request->all());
        return redirect('student/account')->with('success', 'My Info Successfully Updated');
    }
    public function UpdateMyAccountParent(Request $request)
    {
        $id = Auth::user()->id;
        // ? Backend Validation
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'max:15|min:8',
        ]);

        // ? Update Parent
        $parent = User::getSingle($id);
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->gender = trim($request->gender);
        // If There is a profile pic
        if (!empty($request->file('profile_pic'))) {
            // If There is Image Ater Click Upload Delete It
            if (!empty($parent->getProfile())) {
                unlink('upload/profile/' . $parent->profile_pic);
            }
            // Else Create New Image
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);
            $parent->profile_pic = $filename;
        }
        $parent->occupation = trim($request->occupation);
        $parent->address = trim($request->address);
        $parent->mobile_number = trim($request->mobile_number);
        $parent->email = trim($request->email);
        $parent->save();
        return redirect('parent/account')->with('success', 'My Info Successfully Updated');
    }

    public function UpdateMyAccountAdmin(Request $request){
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]);
        $admin = User::getOneAdmin($id);
        $admin->name = trim($request->name);
        $admin->email = trim($request->email);
        $admin->save();
        return redirect('admin/account')->with('success', 'My Admin Info Successfully Updated');

    }
    public function change_password()
    {
        return view('profile.change_password');
    }
    public function update_change_password(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', 'Password Updated');
        } else {
            return redirect()->back()->with('error', 'Icorrect Password');
        }

    }

        // !!!! API !!!!!
        public function index()
        {
            try {
                $users = User::all();
            } catch (Exception $e) {
                return response()->json([
                    'data' => [],
                    'message'=>$e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }

            return response()->json([
                'data' => $users,
                'message' => 'Succeed'
            ], JsonResponse::HTTP_OK);
        }

        public function show($id)
        {
            try {
                $user = User::find($id);
            } catch (Exception $e) {
                return response()->json([
                    'data' => [],
                    'message'=>$e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }

            return response()->json([
                'data' => $user,
                'message' => 'Succeed'
            ], JsonResponse::HTTP_OK);
        }

        public function store(Request $request)
        {
            try {
                $posts = User::create($request->all());
            } catch (Exception $e) {
                return response()->json([
                    'data' => [],
                    'message'=>$e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }

            return response()->json([
                'data' => $posts,
                'message' => 'Succeed'
            ], JsonResponse::HTTP_OK);
        }

        public function updateUser(Request $request, $id)
        {
            try {
                $posts = User::find($id)
                            ->update($request->all());
            } catch (Exception $e) {
                return response()->json([
                    'data' => [],
                    'message'=>$e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }

            return response()->json([
                'data' => $posts,
                'message' => 'Succeed'
            ], JsonResponse::HTTP_OK);
        }

        public function destroyUser($id)
        {
            try {
                $posts = User::destroy($id);
            } catch (Exception $e) {
                return response()->json([
                    'data' => [],
                    'message'=>$e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }

            return response()->json([
                'data' => $posts,
                'message' => 'Succeed'
            ], JsonResponse::HTTP_OK);
        }


        
}
