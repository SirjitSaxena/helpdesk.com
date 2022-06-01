<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\Query;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use App\Models\Timetable;
use App\Models\Course;
use App\Models\Subject;
use PHPUnit\Framework\Constraint\Count;

class AdminController extends Controller
{
    public function add_notice()
    {
        return view('admin.add_notice');
    }
    public function notice_admin()
    {
        $notices = Notice::all()->sortByDesc('date');
        $data = compact('notices');
        return view('admin.notice')->with($data);
    }
    public function query_admin()
    {
        $queries = Query::select("*")->where("sentto", Auth::user()->name)->get();
        $data = compact('queries');
        return view('admin.query')->with($data);
    }
    public function upload_notice(Request $request)
    {
        $notice = new Notice;
        $pdf = $request->file;
        $pdfname = time() . '.' . $pdf->getClientoriginalExtension();
        $request->file->move('noticefile', $pdfname);
        $notice->pdf = $pdfname;
        $notice->name = $request->name;
        $notice->date = $request->date;
        $notice->save();
        return redirect()->back()->with('message', 'Notice Uploaded Successfully');
    }
    public function upload_timetable(Request $request)
    {
        $timetable = new Timetable;
        $pdf = $request->file;
        $pdfname = time() . '.' . $pdf->getClientoriginalExtension();
        $request->file->move('timetablefile', $pdfname);
        $timetable->pdf = $pdfname;
        $timetable->course = $request->course;
        $timetable->semester = $request->semester;
        $timetable->save();
        return redirect()->back()->with('message', 'Timetable Uploaded Successfully');
    }
    public function timetable_admin()
    {
        $timetables = Timetable::all()->sortByDesc('date');
        $data = compact('timetables');
        return view('admin.timetable')->with($data);
    }
    public function add_timetable()
    {
        $courses = Course::all();
        $data = compact('courses');
        $semesters = array("1", "2", "3", "4", "5", "6");
        $data2 = compact('semesters');
        return view('admin.add_timetable')->with($data)->with($data2);
    }
    public function add_student()
    {
        $courses =  Course::all();
        $data = compact('courses');
        return view('admin.add_student')->with($data);
    }
    public function student_added(Request $request)
    {
        $student = new Student;
        $student->name = $request->name;
        $student->admission_year = $request->admission_year;
        $student->course_enrolled = $request->course;
        $student->email = $request->email;
        $student->college_roll_no = $request->roll_no;

        $student->save();
        return redirect()->back()->with('message', 'Student Added Successfully');
    }
    public function add_teacher()
    {
        $departments = array(
            "Department of Applied Psychology",
            "Department of Commerce",
            "Department of Computer Science",
            "Department of Economics",
            "Department of English",
            "Department of Environmental Studies",
            "Department of Hindi",
            "Department of History",
            "Department of Management Studies",
            "Department of Mathematics",
            "Department of Philosophy",
            "Department of Physical Education",
            "Department of Political Science",
            "Department of Punjabi",
            "Department of Statistics",
            "Department of Vocation"
        );
        $data = compact('departments');
        return view('admin.add_teacher')->with($data);
    }
    public function teacher_added(Request $request)
    {
        $teacher = new Teacher;
        $teacher->name = $request->name;

        $teacher->email = $request->email;
        $teacher->department = $request->department;

        $teacher->save();
        return redirect()->back()->with('message', 'Teacher Added Successfully');
    }
    public function course_added(Request $request)
    {
        $course = new Course;
        $course->name = $request->name;
        $course->added_by = Auth::user()->name;
        $course->save();
        return redirect()->back()->with('message', 'Course Added Successfully');
    }
    public function subject_added(Request $request)
    {
        $subject = new Subject;
        $subject->name = $request->name;
        $subject->semester=$request->semester;
        $subject->course_name = $request->course;
        $subject->added_by = Auth::user()->name;
        $subject->save();
        return redirect()->back()->with('message', 'Subject Added Successfully');
    }
    public function add_course()
    {
        $courses = Course::all();
        $data = compact('courses');

        return view('admin.add_course')->with($data);
    }
    public function add_subject()
    {
        $courses = Course::all();
        $data = compact('courses');
        $semesters = array("1", "2", "3", "4", "5", "6");
        $data2 = compact('semesters');
        return view('admin.add_subject')->with($data)->with($data2);
    }
    public function delete_course($id)
    {
        $delete = Course::find($id);
        if (!is_null($delete)) {
            $delete->delete();
            return redirect('add_course')->with('message', 'Course Deleted Successfully');
        }
        return redirect('add_course');
    }
    public function view_subject($id)
    {
        $course = Course::find($id);
        if (!is_null($course)) {

            $subjects = Subject::select("*")->where("course_name", $course->name)->get()->sortBy('semester');
            $data = compact('subjects');
            $data2 = compact('course');
            return view('admin.view_subject')->with($data)->with($data2);
        }
            return redirect('add_course');
        
    }
    public function delete_subject($id)
    {
        $delete = Subject::find($id);
        if (!is_null($delete)) {
            $delete->delete();
            return redirect()->back()->with('message', 'Subject Deleted Successfully');
        }
        return redirect('home');
    }
}
