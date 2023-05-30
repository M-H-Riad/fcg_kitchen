<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Course\Entities\Session;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $sessions = Session::all();
        return view('course::session.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('course::session.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:sessions,name',
        ]);
        if (!$validated) {
            return redirect()->back()->with('errors', 'Name is required and should be unique.');
        }

        DB::beginTransaction();

        try {
            Session::create([
                'name' => $request->name,
                'year' => $request->year,
                'details' => $request->details,
            ]);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->with('errors', $e->getMessage());
        }

        return redirect()->route('session.index')->with('success', 'Data created successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('course::session.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $session = Session::find($id);
        return view('course::session.edit', compact('session'));
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
            'name' => 'required|unique:sessions,name',
        ]);
        if (!$validated) {
            return redirect()->back()->with('errors', 'Name is required and should be unique.');
        }

        DB::beginTransaction();

        try {
            $permission = Session::find($id);
            $permission->name = $request->name;
            $permission->year = $request->year;
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

        return redirect()->route('session.index')->with('success', 'Data updated successfully');
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
            $session = Session::find($id);
            $session->delete();

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->back()->with('errors', $e->getMessage());
        }

        return redirect()->route('session.index')->with('success', 'Data deleted successfully');
    }
}
