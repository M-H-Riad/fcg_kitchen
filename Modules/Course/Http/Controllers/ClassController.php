<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Course\Entities\ClassModel;
use Modules\Course\Entities\Session;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $sessions = ClassModel::with(['sessionData'])->get();
        // dd($sessions);
        return view('course::class.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $sessions = Session::all();
        return view('course::class.create', compact('sessions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:class_models,name',
            'session_id' => 'required|integer',
        ]);
        if (!$validated) {
            return redirect()->back()->with('errors', 'Name is required and should be unique.');
        }

        DB::beginTransaction();

        try {
            ClassModel::create([
                'name' => $request->name,
                'session_id' => $request->session_id,
                'details' => $request->details,
            ]);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->with('errors', $e->getMessage());
        }

        return redirect()->route('class.index')->with('success', 'Data created successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('course::class.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $sessions = Session::all();
        $class = ClassModel::find($id);
        return view('course::class.edit', compact('sessions', 'class'));
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
            'name' => 'required|unique:class_models,name, ' . $id,
            'session_id' => 'required|integer',
        ]);
        if (!$validated) {
            return redirect()->back()->with('errors', 'Name is required and should be unique.');
        }

        DB::beginTransaction();

        try {
            $permission = ClassModel::find($id);
            $permission->name = $request->name;
            $permission->session_id = $request->session_id;
            $permission->details = $request->details;
            $permission->status = $request->status;
            $permission->save();

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->with('errors', $e->getMessage());
        }

        return redirect()->route('class.index')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $session = ClassModel::find($id);
            $session->delete();

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->with('errors', $e->getMessage());
        }

        return redirect()->route('class.index')->with('success', 'Data deleted successfully');
    }
}
