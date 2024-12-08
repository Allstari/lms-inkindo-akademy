<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Course;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    // Menampilkan semua meeting beserta kursus yang terkait
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $meetings = Meeting::with('course')->get();
            return response()->json([
                'meetings' => $meetings
            ]);
        }

        return view('meetings.index'); // Tampilan untuk menampilkan daftar meeting
    }

    // Membuat meeting baru
    public function store(Request $request)
    {
        if ($request->ajax()) {
            // Validasi input dari form
            $validatedData = $request->validate([
                'course_id' => 'required|exists:courses,id', // Pastikan ID kursus valid
                'meeting_time' => 'required|date', // Pastikan waktu meeting valid
            ]);

            // Membuat meeting baru
            $meeting = Meeting::create([
                'course_id' => $validatedData['course_id'],
                'meeting_time' => $validatedData['meeting_time'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Meeting berhasil dibuat!',
                'meeting' => $meeting
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Permintaan tidak valid'], 400);
    }

    // Menampilkan detail meeting
    public function show($id)
    {
        $meeting = Meeting::with('course')->findOrFail($id);

        return response()->json([
            'meeting' => $meeting
        ]);
    }
}
