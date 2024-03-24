<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ClassSubjectTimeTableModel;
use App\Models\WeekModel;
use Illuminate\Http\Request;

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
                $ClassSubject = ClassSubjectTimeTableModel::getRecord($request->class_id,$request->subject_id,$value->id);

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

}
