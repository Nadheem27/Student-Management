<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CommonController;
use App\Http\Requests\MarkStoreRequest;
use App\Http\Requests\MarkUpdateRequest;
use App\Models\Students;
use App\Models\Marks;
use App\Models\Term;
use DB;

class MarksController extends CommonController
{
    public function mark()
    {
        return view('marks.list');
    }

    public function markList(Request $request)
    {
        $data = array();
        $search = $request->search['value'];

        $marks = Marks::orderBy('id', 'ASC');

        if(!is_null($search)) 
        {
            $marks->where(function($q) use ($search) {
                $q->search($search)
                ->orWhereHas('student', function($r) use ($search) {
                    $r->search($search);
                })->orWhereHas('term', function($s) use ($search) {
                    $s->search($search);
                });
            });
        }

        $result['recordsTotal'] = $marks->count();
        $result['recordsFiltered'] = $marks->count();

        $marks = $marks->take($request->length)->skip($request->start)->get();

        if(count($marks) == 0) {
            $result['data'] = $data;
            return json_encode($result);
        }

        foreach($marks as $mark)
        {
            $data[] = array(
                'id' => $mark->id,
                'name' => $mark->student->name,
                'maths' => $mark->maths,
                'science' => $mark->science,
                'history' => $mark->history,
                'term' => $mark->term->name,
                'total' => $mark->total_mark,
                'created' => date('F d, Y h:i A', strtotime($mark->created_at)),
                'edit' => route('mark.mark-edit', [$mark->id]),
                'delete' => 'deleteMark('.$mark->id.')'
            );
        }

        $result['data'] = $data;
        return json_encode($result);
    }

    public function markAdd()
    {
        $students = Students::select('id', 'name')->get();
        $term = Term::select('id', 'name')->get();

        return view('marks.add')->with('students', $students)->with('terms', $term);
    }

    public function markStore(MarkStoreRequest $request)
    {
        $mark_exists = Marks::where(['student_id' => $request->student, 'term_id' => $request->term])->exists();

        if($mark_exists) {
            flash()->addError('Sorry !!, Mark has been already entered for the Term');
            return redirect()->back()->withInput();
        }

        DB::beginTransaction();

        try {

            $marks = Marks::create([
                'student_id' => $request->student,
                'term_id' => $request->term,
                'maths' => $request->maths_mark,
                'science' => $request->science_mark,
                'history' => $request->history_mark
            ]);

        } catch (Exception $e) {

            DB::rollback();
            Log::info('Mark Creation Error : '. json_encode($e->getMessage()));

            flash()->addError('Sorry !!, Something went wrong !.');
            return redirect()->back()->withInput();
        }

        DB::commit();

        flash()->addSuccess('Mark inserted successfully');
        return redirect(route('mark.mark'));
    }

    public function markEdit($id)
    {
        $mark = Marks::find($id);

        if(is_null($mark)) {
            flash()->addError('Record not Found');
            return redirect(route('mark.mark'));
        }

        $students = Students::select('id', 'name')->get();
        $term = Term::select('id', 'name')->get();

        return view('marks.edit')->with('students', $students)->with('terms', $term)->with('mark', $mark);
    }

    public function markUpdate(MarkUpdateRequest $request)
    {
        $mark_exists = Marks::where(['student_id' => $request->student, 'term_id' => $request->term])
                            ->where('id', '!=', $request->id)
                            ->exists();

        if($mark_exists) {
            flash()->addError('Sorry !!, Mark has been already entered for the Term');
            return redirect()->back()->withInput();
        }

        DB::beginTransaction();

        $marks = Marks::find($request->id);

        try {

            $marks->update([
                'student_id' => $request->student,
                'term_id' => $request->term,
                'maths' => $request->maths_mark,
                'science' => $request->science_mark,
                'history' => $request->history_mark
            ]);

        } catch (Exception $e) {

            DB::rollback();
            Log::info('Mark Updation Error : '. json_encode($e->getMessage()));

            flash()->addError('Sorry !!, Something went wrong !.');
            return redirect()->back()->withInput();
        }

        DB::commit();

        flash()->addSuccess('Details updated successfully');
        return redirect(route('mark.mark'));
    }

    public function markDelete(Request $request)
    {
        $marks = Marks::find($request->id);

        if(is_null($marks))
            return response()->json(['code' => 1, 'message' => 'Record not Found']);

        $marks->delete();

        return response()->json(['code' => 0, 'message' => 'Record deleted successfully']);
    }
}
