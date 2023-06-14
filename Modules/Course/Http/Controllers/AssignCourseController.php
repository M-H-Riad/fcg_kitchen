<?php

namespace Modules\Course\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Course\Entities\AssignCourse;
use Modules\Course\Entities\CourseModel;

class AssignCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $courses = CourseModel::select('id', 'name')->get();
        $students = User::select('id', 'name')->get();
        $datas = AssignCourse::orderBy('id', 'desc')->get();
        return view('course::assign-course.index', compact('courses', 'students', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $courses = CourseModel::select('id', 'name')->get();
        $students = User::select('id', 'name')->where('designation', 'user')->get();
        return view('course::assign-course.create', compact('courses', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|integer',
            'student_id' => 'required|integer',
        ]);
        if (!$validated) {
            return redirect()->back()->with('errors', 'Please select the required field.');
        }
        $oldData = AssignCourse::where('course_id', $request->course_id)
            ->where('student_id', $request->student_id)->first();
        if ($oldData) {
            return redirect()->back()->with('errors', 'Already assigned this course.');
        }

        DB::beginTransaction();

        try {
            AssignCourse::create([
                'course_id' => $request->course_id,
                'student_id' => $request->student_id,
                'payment' => $request->payment
            ]);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->with('errors', $e->getMessage());
        }

        return redirect()->route('assign-course.index')->with('success', 'Data created successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('course::assign-course.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = AssignCourse::find($id);
        $courses = CourseModel::select('id', 'name')->get();
        $students = User::select('id', 'name')->where('designation', 'user')->get();
        return view('course::assign-course.edit', compact('data', 'courses', 'students'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'course_id' => 'required|integer',
            'student_id' => 'required|integer',
        ]);
        if (!$validated) {
            return redirect()->back()->with('errors', 'Please select the required field.');
        }

        DB::beginTransaction();

        try {
            $assign = AssignCourse::find($id);
            $assign->update([
                'course_id' => $request->course_id,
                'student_id' => $request->student_id,
                'payment' => $request->payment,
                'status' => $request->status
            ]);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->with('errors', $e->getMessage());
        }

        return redirect()->route('assign-course.index')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
