<?php

namespace App\Http\Controllers;

use App\teacher;
use App\TeacherClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $teachers = DB::table('teachers')
            ->join('teacher_classes', 'teachers.id', '=', 'teacher_classes.teacher_id')
            ->leftjoin('mclasses', 'teacher_classes.class_id', '=', 'mclasses.id')
            ->select('teachers.*', DB::raw("group_concat(DISTINCT mclasses.name ORDER BY mclasses.name DESC SEPARATOR ', ') AS 'allclasses'"))
            ->groupBy('teachers.id')

            ->get();




        return view('teacher.list', ['data' => $teachers]);
    }


    public function create()
    {
        return view('teacher.add');
    }


    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:teachers|max:255',
            'name' => 'required',
            'subject' => 'required',
            'phone' => 'required',
        ]);


        $teacher = new teacher;

        $teacher->name = $request->name;
        $teacher->subject = $request->subject;
        $teacher->email = $request->email;
        $teacher->phone = $request->phone;
        // FOR FUTURE USE ONLY
        $teacher->password = '87654321';
        // FOR FUTURE USE ONLY
        $teacher->save();
        $last_id = $teacher->id;

        if (isset($last_id) && $last_id > 0) {
            if (!empty($request->classes) > 0) {
                $this->assignClasses($request->classes, $last_id);
            }
        } else {
            abort('some error');
        }

        return redirect('teachers')->with('status', 'TEacher Added!');
    }

    public function assignClasses($data = null, $teacher_id = null)
    {

        $length = count($data);
        $date_arr = [];
        for ($i = 0; $i < $length; $i++) {
            $date_arr[$i] = ['teacher_id' => $teacher_id, 'class_id' => $data[$i], 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(),];
        }

        DB::table('teacher_classes')->insert($date_arr);
        return true;
    }


    public function show(teacher $teacher)
    {
        //
    }


    public function edit($id)
    {
        if (isset($id) && empty($id)) {
            return redirect('teachers')->with('status', 'No record found!');
        }
        $teacher = teacher::find($id);
        if (isset($teacher) && !empty($teacher)) {
            return view('teacher.edit', ['teacher' => $teacher]);
        } else {
            return redirect('teachers')->with('status', 'No record found!');
        }
    }


    public function update(Request $request, $id)
    {
        $check_count = count($request->all());
        if ($check_count == null) {
            return abort(404);
        }
        $request->validate([
            'email' => "required|string|max:255|unique:teachers,email,{$id}",
            'name' => 'required',
            'subject' => 'required',
            'phone' => 'required',
        ]);

        $res = DB::table('teachers')
            ->where('id', $id)
            ->update(
                ['name' => $request->name, 'subject' => $request->subject, 'email' => $request->email, 'phone' => $request->phone]
            );
        return redirect('teachers')->with('status', 'record is updated!');
    }


    public function destroy($id)
    {
        DB::table('teachers')->delete($id);
        return redirect('teachers')->with('status', 'Teacher is deleted!');
    }

    public function showAssignClass()
    {
        $teachers = teacher::all();
        return view('teacher.assign', ['teachers' => $teachers]);
    }

    public function classAssign(Request $request)
    {
        $check_count = count($request->all());
        if ($check_count == null) {
            return abort(404);
        }
        $request->validate([
            'teacher' => 'required',
            'classes' => 'required',
        ]);

        $this->assignClasses($request->classes, $request->teacher);
        return redirect('teachers')->with('status', 'Classes assigned to teacher!');
    }

    public function attendanceShow()
    {
        $teachers = DB::table('teachers')
            ->select('teachers.*')
            ->get();

        $t_length = count($teachers);
        for ($i = 0; $i < $t_length; $i++) {
            $a_status = $this->checkdailyAttendance($teachers[$i]->id);
            $teachers[$i]->status = $a_status;
        }

        return view('teacher.attendance-list', ['data' => $teachers]);
    }

    public function checkdailyAttendance($teacher_id)
    {
        $status_arr = DB::table('attendances')
            ->select('status')
            ->whereRaw('Date(created_at) = CURDATE()')
            ->where('teacher_id', '=', $teacher_id)
            ->get();
        if (isset($status_arr) > 0 && count($status_arr) > 0) {
            $status = $status_arr[0]->status;
        } else {
            $status = 0;
        }
        return $status;
    }

    public function updateAttendance(Request $request, $id)
    {
        $check_count = count($request->all());

        if ($check_count == null && $id == null) {
            return abort(404);
        }
        //CHECK IF ALREADY RECORD AVAILABLE WITH TODAY DATE SEND MESSAGE IT ALREADY MARKED
        if ($request->status == 'off') {
            $status = 2;
        } else {
            $status = 1;
        }
        DB::table('attendances')->insert(['teacher_id' => $id, 'status' => $status, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]);

        return redirect('teacher/attendance')->with('status', 'attendance is updated!');
    }
}
