<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function list()
    {

        $data['classes'] = ClassModel::getClasses();
        return view('admin.class.list', $data);
    }
    public function add()
    {
        return view('admin.class.add');
    }
    public function PostAdd(Request $request)
    {

        $class = new ClassModel();
        $class->name = $request->name;
        $class->status = $request->status;
        $class->created_by = Auth::user()->id;
        $class->save();
        return redirect('admin/class/list')->with('success', 'Class Successfully Addded');
    }
    public function edit($id)
    {
        $data['class'] = ClassModel::getClassByID($id);
        if (!empty($data)) {
            return view('admin.class.edit', $data);
        } else {
            abort(404);
        }
    }
    public function PostEdit($id, Request $request)
    {
        $class = ClassModel::getClassByID($id);
        $class->name = $request->name;
        $class->status = $request->status;
        $class->save();
        return redirect('admin/class/list')->with('success', 'Class Successfully Updated');
    }
    public function delete($id)
    {
        $class = ClassModel::getClassByID($id);
        $class->is_delete = 1;
        $class->save();
        return redirect('admin/class/list')->with('success', 'Class Successfully Deleted');
    }
}
