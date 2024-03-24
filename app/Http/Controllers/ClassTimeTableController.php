<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacherModel;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ClassSubjectTimeTableModel;
use App\Models\SubjectModel;
use App\Models\WeekModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassTimeTableController extends Controller
{
    public function list(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        if (!empty($request->class_id)) {
            $data['getSubject'] = ClassSubjectModel::getMySubjects($request->class_id);
        }
        $getWeek = WeekModel::getRecord();
        $week = array();
        foreach ($getWeek as $value):
            $dataW['week_id'] = $value->id;
            $dataW['week_name'] = $value->name;
            if (!empty($request->class_id) && !empty($request->subject_id)) {
                $ClassSubject = ClassSubjectTimeTableModel::getRecord($request->class_id, $request->subject_id, $value->id);

                if (!empty($ClassSubject)) {
                    $dataW['start_time'] = $ClassSubject->start_time;
                    $dataW['end_time'] = $ClassSubject->end_time;
                    $dataW['room_number'] = $ClassSubject->room_number;
                } else {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                }
            } else {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room_number'] = '';
            }
            $week[] = $dataW;
        endforeach;
        $data['week'] = $week;
        // dd($data['week']);


        return view('admin.class_timetable.list', $data);
    }

    public function get_subject(Request $request)
    {
        $getSubject = ClassSubjectModel::getMySubjects($request->class_id);
        $html = "<option value=''>Select</option>";
        foreach ($getSubject as $subject):
            $html .= "<option value='$subject->subject_id'>$subject->subject_name</option>";
        endforeach;
        $json['html'] = $html;
        echo json_encode($json);

    }

    public function insert_update(Request $request)
    {
        // dd($request->all());
        ClassSubjectTimeTableModel::where('class_id', '=', $request->class_id)->where('subject_id', '=', $request->subject_id)->delete();
        foreach ($request->timetable as $timetable):
            if (!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room_number'])) {
                $save = new ClassSubjectTimeTableModel;
                $save->subject_id = $request->subject_id;
                $save->class_id = $request->class_id;
                $save->week_id = $timetable['week_id'];
                $save->start_time = $timetable['start_time'];
                $save->end_time = $timetable['end_time'];
                $save->room_number = $timetable['room_number'];
                $save->save();
            }
        endforeach;
        return redirect()->back()->with('success', "Class Timetable Sucessfully Saved");
    }

    // ** Student Side

    public function my_Timetable()
    {
        $result = array();
        $getRecord = ClassSubjectModel::getMySubjects(Auth::user()->class_id);
        foreach ($getRecord as $value):
            $dataS['name'] = $value->subject_name;
            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach ($getWeek as $valueW):
                $dataW = array();
                $dataW['week_id'] = $valueW->id;
                $dataW['week_name'] = $valueW->name;
                $ClassSubject = ClassSubjectTimeTableModel::getRecord($value->class_id, $value->subject_id, $valueW->id);
                if (!empty($ClassSubject)) {
                    $dataW['start_time'] = $ClassSubject->start_time;
                    $dataW['end_time'] = $ClassSubject->end_time;
                    $dataW['room_number'] = $ClassSubject->room_number;
                } else {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                }
                $week[] = $dataW;
            endforeach;
            $dataS['week'] = $week;
            $result[] = $dataS;
        endforeach;
        $data['result'] = $result;
        return view('student.my_timetable', $data);
    }

    // ** Teacher Side
    public function my_TimetableTeacher($classID, $subjectID)
    {
        $data['getClass'] = ClassModel::getClassByID($classID);
        $data['getSubject'] = SubjectModel::getSubjectByID($subjectID);
        $getWeek = WeekModel::getRecord();
        $week = array();
        foreach ($getWeek as $valueW):
            $dataW = array();
            $dataW['week_id'] = $valueW->id;
            $dataW['week_name'] = $valueW->name;
            $ClassSubject = ClassSubjectTimeTableModel::getRecord($classID, $subjectID, $valueW->id);
            if (!empty($ClassSubject)) {
                $dataW['start_time'] = $ClassSubject->start_time;
                $dataW['end_time'] = $ClassSubject->end_time;
                $dataW['room_number'] = $ClassSubject->room_number;
            } else {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room_number'] = '';
            }
            $result[] = $dataW;
        endforeach;

        $data['result'] = $result;
        return view('teacher.my_timetable', $data);
    }

}
