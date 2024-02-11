<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ParentController extends Controller
{
    public function list()
    {
        $data['parents'] = User::getParents();
        return view('admin.parent.list', $data);
    }
    public function add()
    {
        return view('admin.parent.add');
    }
    public function PostAdd(Request $request)
    {

        // ? Backend Validation
        request()->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:8',
        ]);

        // ?Add New Parent
        $parent = new User;
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->gender = trim($request->gender);
        if (!empty($request->file('profile_pic'))) {
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
        $parent->status = trim($request->status);
        $parent->email = trim($request->email);
        $parent->password = Hash::make($request->password);
        $parent->user_type = 4;
        $parent->save();

        // dd($request->all());
        return redirect('admin/parent/list')->with('success', 'Parent Successfully Created');
    }
    public function edit($id)
    {
        $data['parent'] = User::getSingle($id);
        if (!empty($data['parent'])) {
            return view('admin.parent.edit', $data);
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
        $parent->status = trim($request->status);
        $parent->email = trim($request->email);
        if (!empty($request->password)) {
            $parent->password = Hash::make($request->password);
        }
        $parent->save();
        return redirect('admin/parent/list')->with('success', 'Parent Successfully Updated');
    }
    public function delete($id)
    {
        $parent = User::getSingle($id);
        if (!empty($parent)) {
            $parent->is_delete = 1;
            $parent->save();
        }
        return redirect('admin/parent/list')->with('success', 'Parent Successfully Deleted');
    }

    public function myStudent($id)
    {
        $data['parent'] = User::getSingle($id);
        $data['parent_id'] = $id;
        $data['getSearchStudents'] = User::getSearchStudents();
        $data['parentStudents'] = User::getMyStudents($id);
        return view('admin.parent.my_student', $data);
    }
    public function AssignStudentParent($studentID, $parentID)
    {
        $student = User::getSingle($studentID);
        $student->parent_id = $parentID;
        $student->save();
        return redirect()->back()->with('success', 'Student Successfully Asssigned');
    }
    public function AssignStudentParentDelete($studentID){
        $student = User::getSingle($studentID);
        $student->parent_id = null;
        $student->save();
        return redirect()->back()->with('success', 'Student Assigned Deleted');
    }


}
