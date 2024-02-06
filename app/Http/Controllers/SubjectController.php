<?php

namespace App\Http\Controllers;

use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function list()
    {

        $data['subjects'] = SubjectModel::getSubjects();
        return view('admin.subject.list', $data);
    }
    public function add()
    {
        return view('admin.subject.add');
    }
    public function PostAdd(Request $request)
    {

        $subject = new SubjectModel();
        $subject->name = trim($request->name);
        $subject->type = trim($request->type);
        $subject->status = trim($request->status);
        $subject->created_by = Auth::user()->id;
        $subject->save();
        return redirect('admin/subject/list')->with('success', 'Subject Successfully Addded');
    }
    public function edit($id)
    {
        $data['subject'] = SubjectModel::getSubjectByID($id);
        if (!empty($data)) {
            return view('admin.subject.edit', $data);
        } else {
            abort(404);
        }
    }
    public function PostEdit($id, Request $request)
    {
        $subject = SubjectModel::getSubjectByID($id);
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->status = $request->status;
        $subject->save();
        return redirect('admin/subject/list')->with('success', 'Subject Successfully Updated');
    }
    public function delete($id)
    {
        $subject = SubjectModel::getSubjectByID($id);
        $subject->is_delete = 1;
        $subject->save();
        return redirect('admin/subject/list')->with('success', 'Subject Successfully Deleted');
    }
}
