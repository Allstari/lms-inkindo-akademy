<?php

namespace App\Http\Controllers\Admin;

use App\Models\Material;
use App\Models\Assignment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AssignmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->roles->contains('name', 'author')) {
                $assignments = Assignment::all();
            } else {
                $assignments = Assignment::whereHas('material.topic.course', function ($query) {
                    $query->where('instructor_id', Auth::user()->instructor->id);
                })
                    ->with('material.topic.course')
                    ->get();
            }

            return DataTables::of($assignments)->make();
        }

        return view('admin.assignment.index');
    }

    public function create()
    {
        if (Auth::user()->roles->contains('name', 'author')) {
            $materials = Material::where('type', 'assignment')
                ->with('topic.course')
                ->get();
        } else {
            $materials = Material::where('type', 'assignment')
                ->whereHas('topic.course', function ($query) {
                    $query->where('instructor_id', Auth::user()->instructor->id);
                })
                ->with('topic.course')
                ->get();
        }

        return view('admin.assignment.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'material_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
        ]);

        Assignment::create([
            'title' => $validatedData['title'],
            'material_id' => $validatedData['material_id'],
            'description' => $validatedData['description'],
            'due_date' => $validatedData['due_date'],
        ]);

        return redirect()->route('dashboard.assignment.index')->with('success', 'Tugas Berhasil Ditambahkan.');
    }

    public function edit(Assignment $assignment)
    {
        if (Auth::user()->roles->contains('name', 'author')) {
            $materials = Material::where('type', 'assignment')
                ->with('topic.course')
                ->get();
        } else {
            $materials = Material::where('type', 'assignment')
                ->whereHas('topic.course', function ($query) {
                    $query->where('instructor_id', Auth::user()->instructor->id);
                })
                ->with('topic.course')
                ->get();
        }

        return view('admin.assignment.edit', compact('assignment', 'materials'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $validatedData = $request->validate([
            'material_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
        ]);

        $assignment->update([
            'title' => $validatedData['title'],
            'material_id' => $validatedData['material_id'],
            'description' => $validatedData['description'],
            'due_date' => $validatedData['due_date'],
        ]);

        return redirect()->route('dashboard.assignment.index')->with('success', 'Tugas Berhasil Diupdate.');
    }

    public function destroy(Assignment $assignment)
    {
        $assignment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tugas Berhasil Dihapus',
        ]);
    }
}
