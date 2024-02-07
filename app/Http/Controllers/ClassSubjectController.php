<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\SubjectModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClassSubjectController extends Controller
{
    public function list(Request $request)
    {
        $data['subjects'] = ClassSubjectModel::getAssignedSubjects();
        return view('admin.assign_subject.list', $data);
    }
    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();
        return view('admin.assign_subject.add', $data);
    }
    public function PostAdd(Request $request)
    {
        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subjectID):
                $countAlready = ClassSubjectModel::countAlready($request->class_id, $subjectID);
                if (!empty($countAlready)) {
                    $countAlready->status = $request->status;
                    $countAlready->save();
                } else {
                    $save = new ClassSubjectModel;
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subjectID;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }

            endforeach;
            return redirect('admin/assign_subject/list')->with('success', 'Subjects Successfully Assigned');

        } else {
            return redirect()->back()->with('error', 'Some Error Happened');

        }

    }

    public function edit($id)
    {
        $data['assignedSubject'] = ClassSubjectModel::getAssingedSubjectByID($id);
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();
        $data['AssingedSubjectsInSameClass'] = ClassSubjectModel::getAssignedSubjectsByClassID($data['assignedSubject']->class_id);
        if (!empty($data)) {
            return view('admin.assign_subject.edit', $data);
        } else {
            abort(404);
        }
    }
    public function PostEdit($id, Request $request)
    {
        // Delete All Assinged Subjects To Same Class
        ClassSubjectModel::deleteSubject($request->class_id);

        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subjectID):
                $countAlready = ClassSubjectModel::countAlready($request->class_id, $subjectID);
                if (!empty($countAlready)) {
                    $countAlready->status = $request->status;
                    $countAlready->save();
                } else {
                    $save = new ClassSubjectModel;
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subjectID;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }

            endforeach;
            return redirect('admin/assign_subject/list')->with('success', 'Subjects Successfully Updated');

        } else {
            return redirect()->back()->with('error', 'Some Error Happened');

        }
    }
    public function delete($id)
    {
        $subject = ClassSubjectModel::getAssingedSubjectByID($id);
        // $subject->is_delete = 1;
        $subject->delete();
        return redirect('admin/assign_subject/list')->with('success', 'Assigned Subject Successfully Deleted');
    }

}
