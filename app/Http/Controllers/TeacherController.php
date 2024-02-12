<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function list()
    {
        $data['teachers'] = User::getTeachers();
        return view('admin.teacher.list', $data);
    }
    public function add()
    {
        return view('admin.teacher.add', );
    }
    public function PostAdd(Request $request)
    {
        // ? Backend Validation
        request()->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:8',
        ]);


        // ?Add New Teacher
        $teacher = new User;
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

        if (!empty($request->file('profile_pic'))) {
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
        $teacher->note = trim($request->note);
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 2;
        $teacher->save();

        // dd($request->all());
        return redirect('admin/teacher/list')->with('success', 'Teacher Successfully Created');
    }

    public function edit($id)
    {
        $data['teacher'] = User::getSingle($id);
        if (!empty($data['teacher'])) {
            return view('admin.teacher.edit', $data);
        } else {
            abort(404);
        }
    }
    public function PostEdit($id, Request $request)
    {

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
        $teacher->note = trim($request->note);
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        if (!empty($request->password)) {
            $teacher->password = Hash::make($request->password);
        }
        $teacher->save();


        // dd($request->all());
        return redirect('admin/teacher/list')->with('success', 'Teacher Successfully Updated');
    }
    public function delete($id)
    {
        $teacher = User::getSingle($id);
        if (!empty($teacher)) {
            $teacher->is_delete = 1;
            $teacher->save();
        }
        return redirect('admin/teacher/list')->with('success', 'Teacher Successfully Deleted');
    }


}
