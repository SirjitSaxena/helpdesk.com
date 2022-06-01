<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Notice;
use App\Models\Query;
use App\Models\Student;
use App\Models\Course;
use App\Models\Timetable;
use App\Models\Teacher;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\AssignOp\Div;

class HomeController extends Controller
{
    public function redirect()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == '0') {

                return view('user.home');
            } elseif (Auth::user()->usertype == '1') {
                return view('teacher.home');
            } else {
                return view('admin.home');
            }
        } else {
            return redirect()->back();
        }
    }
    public function index()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == '0') {

                return view('user.home');
            } elseif (Auth::user()->usertype == '1') {
                return view('teacher.home');
            } else {
                return view('admin.home');
            }
        } else {
            return view('user.home');
        }
    }
    public function my_profile()
    {
        if (Auth::id()) {
            $student = Student::select("*")->where("email", Auth::user()->email)->get();
            $data = compact('student');

            return view('user.my_profile')->with($data);
        } else {
            return Redirect(url('login'));
        }
    }
    public function check_teacher()
    {
        if (Auth::id()) {
            $teacher = Teacher::select("*")->where("email", Auth::user()->email)->get();

            $data = compact('teacher');
            return view('teacher.my_profile')->with($data);
        } else {
            return Redirect(url('login'));
        }
    }
    public function edit_my_profile($id)
    {
        $student = Student::find($id);
        if (is_null($student)) {
            return redirect('my_profile');
        } else {

            $blood_groups = array("O+", "O-", "A+", "A-", "B+", "B-", "AB+", "AB-");
            $data = compact('student');
            $data2 = compact('blood_groups');

            return view('user.my_profile_edit')->with($data)->with($data2);
        }
    }
    public function my_profile_edited($id, Request $request)
    {

        $student = Student::find($id);

        $student->gender = $request->gender;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->blood_group = $request->blood;
        $image = $request->dp;
        if (is_null($image)) {
            $student->save();
            return redirect('my_profile')->with('message', "Profile Edited Successfully");
        } else {
            $ext = $image->getClientoriginalExtension();
            if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'JPG' || $ext == 'JPEG' || $ext == 'PNG') {
            } else {
                $student->save();
                return redirect()->back()->with('message', "Please upload a valid image.");
            }


            if (is_null($student->profile_photo_path)) {
            } else {
                unlink(public_path("dp/$student->profile_photo_path"));
            }
            $dpname = time() . '.' . $image->getClientoriginalExtension();
            $student->profile_photo_path = $dpname;
            $request->dp->move('dp', $dpname);
            $student->save();
            return redirect('my_profile')->with('message', "Profile Edited Successfully");
        }
    }
    public function edit_teacher_my_profile($id)
    {

        $teacher = Teacher::find($id);
        if (is_null($teacher)) {
            return redirect('my_profile');
        } else {
            $user_teacher = User::find(Auth::id());
            $user_teacher->usertype = 1;
            $user_teacher->save();
            $departments=array("Department of Applied Psychology",
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
    
            $blood_groups = array("O+", "O-", "A+", "A-", "B+", "B-", "AB+", "AB-");
            $data = compact('teacher');
            $data2 = compact('blood_groups');
            $data3=compact('departments');

            return view('teacher.my_profile_edit')->with($data)->with($data2)->with($data3);
        }
    }
    public function teacher_my_profile_edited($id, Request $request)
    {

        $teacher = Teacher::find($id);

        $teacher->gender = $request->gender;
        $teacher->phone = $request->phone;
        $teacher->address = $request->address;
        $teacher->blood_group = $request->blood;
        $image = $request->dp;
        if (is_null($image)) {
            $teacher->save();
            return redirect('check_teacher')->with('message', "Profile Edited Successfully");
        } else {
            $ext = $image->getClientoriginalExtension();
            if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'JPG' || $ext == 'JPEG' || $ext == 'PNG') {
            } else {
                $teacher->save();
                return redirect()->back()->with('message', "Please upload a valid image.");
            }


            if (is_null($teacher->profile_photo_path)) {
            } else {
                unlink(public_path("dp/$teacher->profile_photo_path"));
            }
            $dpname = time() . '.' . $image->getClientoriginalExtension();
            $teacher->profile_photo_path = $dpname;
            $request->dp->move('dp', $dpname);
            $teacher->save();
            return redirect('check_teacher')->with('message', "Profile Edited Successfully");
        }
    }

    public function notice()
    {
        $notices = Notice::all()->sortByDesc('date');
        $data = compact('notices');
        return view('user.notice')->with($data);
    }

    public function query()
    {
        if (Auth::id()) {
            $admins = User::select("*")->whereIn("usertype", ['1', '2'])->get();
            $data = compact('admins');
            $queries = Query::select("*")->where("sentby", Auth::user()->name)->get();
            $data2 = compact('queries');
            return view('user.query')->with($data)->with($data2);
        } else {
            return Redirect(url('login'));
        }
    }
    public function upload_query(Request $request)
    {
        $query = new Query;
        $query->sentby = Auth::user()->name;
        $query->name = $request['name'];
        $query->full_query = $request['message'];
        $query->sentto = $request['sentto'];
        $query->save();
        return redirect()->back()->with('message', 'Query Sent Successfully');
    }
    public function delete_query($id)
    {
        $delete = Query::find($id);
        if (!is_null($delete)) {
            $delete->delete();
            return redirect('query')->with('message', 'Query Deleted Successfully');
        }
        return redirect('query');
    }
    public function timetable()
    {
        $timetable = Timetable::all()->sortByDesc('date');
        $data = compact('timetable');
        return view('user.timetable')->with($data);
    }
    public function view_my_attendance()
    {
        $courses = Course::all();
        $data = compact('courses');
        $semesters = array("1", "2", "3", "4", "5", "6");
        $data2 = compact('semesters');
        return view('user.view_attendance')->with($data)->with($data2);
    }
    
    public function fetching_my_attendance(Request $request)
    {
        $attendance = Attendance::select("*")->where("course", $request->course)->where("subject", $request->subject)->where("student_name", Auth::user()->name)->where("semester", $request->semester)->get()->sortBy('created_at');
        $data = compact('attendance');
        $information = $request;
        $data2 = compact('information');
        return view('user.attendance_view_list')->with($data)->with($data2);
    }
}
