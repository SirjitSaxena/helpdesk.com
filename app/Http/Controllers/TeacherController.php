<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Student;
use PhpParser\Node\Stmt\While_;

class TeacherController extends Controller
{
    public function take_attendance(Request $request)
    {
        $courses = Course::all();
        $data = compact('courses');
        $semesters = array("1", "2", "3", "4", "5", "6");
        $data2 = compact('semesters');
        return view('teacher.take_attendance')->with($data)->with($data2);
    }
    public function getSubject(Request $request)
    {
        $cid = $request->post('cid');
        $subject = Subject::select("*")->where("course_name", $cid)->get();
        $html = '<option value="" hidden>Select Subject</option>';
        foreach ($subject as $list) {
            $html .= '<option value="' . $list->name . '">' . $list->name . '</option>';
        }
        echo $html;
    }
    public function attendance_taken(Request $request)
    {
        $no_of_students = $request->iterator;
        if ($no_of_students == 0) {
            return redirect('home')->with('message', "Zero Students");
        }
        for ($i = 1; $i <= $no_of_students; $i++) {
            $attendance = new Attendance;
            $attendance->course = $request->course;
            $attendance->subject = $request->subject;
            $attendance->semester = $request->semester;
            $attendance->admission_year = $request->year;
            $attendance->attendance_date = $request->date;
            $attendance->taken_by = Auth::user()->name;
            $attendance->no_of_total_attendance=$request->periods;
            $a = 'name' . "$i";
            $attendance->student_name = $request->$a;
            $a = 'roll_no' . "$i";
            $attendance->roll_no = $request->$a;
            $a = 'status' . "$i";

            $attendance->no_of_attendance = $request->$a;
            $attendance->save();
        }
        return redirect('home')->with('message', "Attendance Taken Successfully");
    }
    public function student_list_for_attendance(Request $request)
    {
        $students = Student::select("*")->where("course_enrolled", $request->course)->where("admission_year", $request->year)->get()->sortBy('college_roll_no');
        $data = compact('students');
        $information = $request;
        $data2 = compact('information');
        return view('teacher.attendance_list')->with($data)->with($data2);
    }
    public function view_attendance_teacher()
    {
        $courses = Course::all();
        $data = compact('courses');
        $semesters = array("1", "2", "3", "4", "5", "6");
        $data2 = compact('semesters');
        return view('teacher.view_attendance')->with($data)->with($data2);
    }
    public function fetching_attendance_teacher(Request $request)
    {
        $attendance = Attendance::select("*")->where("course", $request->course)->where("subject", $request->subject)->where("admission_year", $request->year)->where("semester", $request->semester)->where("taken_by", Auth::user()->name)->get()->sortBy('student_name');
        $data = compact('attendance');
        $information = $request;
        $data2 = compact('information');
        return view('teacher.attendance_view_list')->with($data)->with($data2);
    }
}
