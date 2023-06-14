<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Course\Entities\ClassModel;
use Modules\Course\Entities\CourseModel;
use Modules\Course\Entities\Session;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $datas = CourseModel::all();
        return view('course::course.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $sessions = Session::all();
        // $classs = ClassModel::select('id', 'name')->get();
        return view('course::course.create', compact('sessions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:course_models,name',
            'instructor' => 'required|string',
            'session_id' => 'required',
            'duration' => 'required|string',
            'url' => 'required|string',
        ]);
        if (!$validated) {
            return redirect()->back()->with('errors', 'Name is required and should be unique.');
        }

        DB::beginTransaction();

        try {
            CourseModel::create([
                'name' => $request->name,
                'session_id' => $request->session_id,
                'instructor' => $request->instructor,
                'duration' => $request->duration,
                'total_class' => $request->total_class,
                'url' => $request->url,
                'details' => $request->details,
            ]);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->with('errors', $e->getMessage());
        }

        return redirect()->route('course.index')->with('success', 'Data created successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $classs = ClassModel::select('id', 'name')->get();
        return view('course::course.show', compact('classs'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data = CourseModel::find($id);
        $sessions = Session::all();
        return view('course::course.edit', compact('sessions', 'data'));
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
            'name' => 'required|unique:course_models,name, ' . $id,
            'instructor' => 'required|string',
            'duration' => 'required|string',
            'url' => 'required|string',
        ]);
        if (!$validated) {
            return redirect()->back()->with('errors', 'Name is required and should be unique.');
        }

        DB::beginTransaction();

        try {
            $course = CourseModel::find($id);
            $course->update([
                'name' => $request->name,
                'session_id' => $request->session_id,
                'instructor' => $request->instructor,
                'duration' => $request->duration,
                'total_class' => $request->total_class,
                'url' => $request->url,
                'details' => $request->details,
            ]);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->with('errors', $e->getMessage());
        }

        return redirect()->route('course.index')->with('success', 'Data updated successfully');
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
