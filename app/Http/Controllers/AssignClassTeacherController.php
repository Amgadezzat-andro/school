<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacherModel;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignClassTeacherController extends Controller
{
    public function list()
    {
        $data['Assigned_Classes'] = AssignClassTeacherModel::getAssignedClasses();
        return view('admin.assign_class_teacher.list', $data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getTeacher'] = User::getTeacherClass();
        return view('admin.assign_class_teacher.add', $data);
    }
    public function PostAdd(Request $request)
    {
        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacherID):

                $countAlready = AssignClassTeacherModel::countAlready($request->class_id, $teacherID);

                if (!empty($countAlready)) {
                    $countAlready->status = $request->status;
                    $countAlready->save();
                } else {
                    $save = new AssignClassTeacherModel;
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $teacherID;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }

            endforeach;
            return redirect('admin/assign_class_teacher/list')->with('success', 'Classes Successfully Assigned To Teachers');

        } else {
            return redirect()->back()->with('error', 'Some Error Happened');

        }
    }

    public function edit($id)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getTeacher'] = User::getTeacherClass();
        $data['assignedTeacher'] = AssignClassTeacherModel::getAssingedTeachertByID($id);
        $data['AssingedTeachersInSameClass'] = AssignClassTeacherModel::getAssignedTeachersByClassID($data['assignedTeacher']->class_id);
        if (!empty($data)) {
            return view('admin.assign_class_teacher.edit', $data);
        } else {
            abort(404);
        }
    }

    public function editSingle($id)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getTeacher'] = User::getTeacherClass();
        $data['assignedTeacher'] = AssignClassTeacherModel::getAssingedTeachertByID($id);
        if (!empty($data)) {
            return view('admin.assign_class_teacher.edit_single', $data);
        } else {
            abort(404);
        }
    }


    public function updateSingle($teacherID, Request $request)
    {
        $countAlready = AssignClassTeacherModel::countAlready($request->class_id, $request->teacher_id);
        if (!empty($request->teacher_id)) {
            if (!empty($countAlready)) {
                $countAlready->status = $request->status;
                $countAlready->save();
                return redirect('admin/assign_class_teacher/list')->with('success', 'Class Status Successfully Updated');
            } else {
                $save = AssignClassTeacherModel::getAssingedTeachertByID($teacherID);
                $save->class_id = $request->class_id;
                $save->teacher_id = $request->teacher_id;
                $save->status = $request->status;
                $save->save();
                return redirect('admin/assign_class_teacher/list')->with('success', 'Classes Successfully Assigned To Teachers');
            }
        }
    }


    public function PostEdit($id, Request $request)
    {
        // ! Delete All Assinged Teachers To Same Class
        AssignClassTeacherModel::deleteTeachers($request->class_id);

        if (!empty($request->teacher_id)) {

            // ** loop Through teacher_id [index]
            foreach ($request->teacher_id as $teacherID):
                $countAlready = AssignClassTeacherModel::countAlready($request->class_id, $teacherID);
                if (!empty($countAlready)) {
                    $countAlready->status = $request->status;
                    $countAlready->save();
                } else {
                    $save = new AssignClassTeacherModel;
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $teacherID;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }

            endforeach;
            return redirect('admin/assign_class_teacher/list')->with('success', 'Teachers Assigned Successfully Updated');

        } else {
            return redirect()->back()->with('error', 'Some Error Happened');

        }
    }

    public function delete($id)
    {
        $subject = AssignClassTeacherModel::getAssingedTeachertByID($id);
        // $subject->is_delete = 1;
        $subject->delete();
        return redirect('admin/assign_class_teacher/list')->with('success', 'Assigned Teacher Successfully Deleted');
    }



}
