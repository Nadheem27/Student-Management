<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CommonController;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Students;
use App\Models\Marks;
use App\Models\Teacher;
use DB;

class StudentController extends CommonController
{
    public function student()
    {
        return view('students.list');
    }

    public function studentList(Request $request)
    {
        $data = array();
        $search = $request->search['value'];

        $students = Students::orderBy('id', 'ASC');

        if(!is_null($search)) 
        {
            $students->where(function($q) use ($search) {
                $q->search($search)
                ->orWhereHas('teacher', function($r) use ($search) {
                    $r->search($search);
                });
            });
        }

        $result['recordsTotal'] = $students->count();
        $result['recordsFiltered'] = $students->count();

        $students = $students->take($request->length)->skip($request->start)->get();

        if(count($students) == 0) {
            $result['data'] = $data;
            return json_encode($result);
        }

        foreach($students as $student)
        {
            $data[] = array(
                'id' => $student->id,
                'name' => $student->name,
                'age' => $student->age,
                'gender' => $student->gender == '0' ? 'F' : 'M',
                'teacher' => $student->teacher->name,
                'edit' => route('student.student-edit', [$student->id]),
                'delete' => 'deleteStudent('.$student->id.')'
            );
        }

        $result['data'] = $data;
        return json_encode($result);
    }

    public function studentAdd()
    {
        $teachers = Teacher::select('id', 'name')->get();
        return view('students.add')->with('teachers', $teachers);
    }

    public function studentStore(StudentStoreRequest $request)
    {
        DB::beginTransaction();

        try {

            $student = Students::create([
                'teacher_id' => $request->teacher,
                'name' => $request->name,
                'age' => $request->age,
                'gender' => $request->gender
            ]);

        } catch (Exception $e) {

            DB::rollback();
            Log::info('Student Creation Error : '. json_encode($e->getMessage()));

            flash()->addError('Sorry !!, Something went wrong !.');
            return redirect()->back()->withInput();
        }

        DB::commit();

        flash()->addSuccess('Student created successfully');
        return redirect(route('student.student'));
    }

    public function studentEdit($id)
    {
        $student = Students::find($id);

        if(is_null($student)) {
            flash()->addError('Student not Found');
            return redirect(route('student.student'));
        }

        $teachers = Teacher::select('id', 'name')->get();

        return view('students.edit')->with('teachers', $teachers)->with('student', $student);
    }

    public function studentUpdate(StudentUpdateRequest $request)
    {
        DB::beginTransaction();

        $student = Students::find($request->id);

        try {

            $student->update([
                'teacher_id' => $request->teacher,
                'name' => $request->name,
                'age' => $request->age,
                'gender' => $request->gender
            ]);

        } catch (Exception $e) {

            DB::rollback();
            Log::info('Student Updation Error : '. json_encode($e->getMessage()));

            flash()->addError('Sorry !!, Something went wrong !.');
            return redirect()->back()->withInput();
        }

        DB::commit();

        flash()->addSuccess('Details updated successfully');
        return redirect(route('student.student'));
    }

    public function studentDelete(Request $request)
    {
        $student = Students::find($request->id);

        if(is_null($student))
            return response()->json(['code' => 1, 'message' => 'Student not Found']);

        Marks::where('student_id', $student->id)->delete();
        $student->delete();

        return response()->json(['code' => 0, 'message' => 'Student deleted successfully']);
    }
}
