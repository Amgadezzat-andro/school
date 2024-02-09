<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

$random = Str::random(40);

class StudentController extends Controller
{
    public function list()
    {
        $data['students'] = User::getStudents();
        return view('admin.student.list', $data);
    }
    public function add()
    {
        $data['getClass'] = ClassModel::getClasses();
        return view('admin.student.add', $data);
    }
    public function PostAdd(Request $request)
    {
        // ? Backend Validation
        request()->validate([
            'email' => 'required|email|unique:users',
            'height' => 'max:10',
            'weight' => 'max:10',
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:8',
            'caste' => 'max:15',
            'religon' => 'max:50',
            'admission_number' => 'max:50',
            'roll_number' => 'max:50',
            'religion' => 'max:50',

        ]);

        // ?Add New Student
        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        if (!empty($request->date_of_birth)) {
            $student->date_of_birth = $request->date_of_birth;
        }
        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);
            $student->profile_pic = $filename;
        }
        if (!empty($request->admission_date)) {
            $student->admission_date = trim($request->admission_date);
        }
        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        $student->blood_group = trim($request->blood_group);
        $student->weight = trim($request->weight);
        $student->height = trim($request->height);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 3;
        $student->save();

        // dd($request->all());
        return redirect('admin/student/list')->with('success', 'Student Successfully Created');
    }

    public function edit($id)
    {
        $data['student'] = User::getSingle($id);
        if (!empty($data['student'])) {
            $data['getClass'] = ClassModel::getClasses();
            return view('admin.student.edit', $data);
        } else {
            abort(404);
        }
    }
    public function PostEdit($id, Request $request)
    {

        // ? Backend Validation
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'height' => 'max:10',
            'weight' => 'max:10',
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:8',
            'caste' => 'max:15',
            'religon' => 'max:50',
            'admission_number' => 'max:50',
            'roll_number' => 'max:50',
            'religion' => 'max:50',

        ]);

        // ? Update Student
        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        if (!empty($request->date_of_birth)) {
            $student->date_of_birth = $request->date_of_birth;
        }

        // If There is a profile pic
        if (!empty($request->file('profile_pic'))) {

            // If There is Image Ater Click Upload Delete It
            if(!empty($student->getProfile())){
                unlink('upload/profile/'.$student->profile_pic);
            }
            // Else Create New Image
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);
            $student->profile_pic = $filename;
        }
        if (!empty($request->admission_date)) {
            $student->admission_date = trim($request->admission_date);
        }
        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        $student->blood_group = trim($request->blood_group);
        $student->weight = trim($request->weight);
        $student->height = trim($request->height);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        if (!empty($request->password)) {
            $student->password = Hash::make($request->password);
        }
        $student->save();

        // dd($request->all());
        return redirect('admin/student/list')->with('success', 'Student Successfully Updated');
    }

}
