<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Course;
use App\Models\MeetingSchedule;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    // Menampilkan semua meeting beserta kursus yang terkait
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $meetings = Meeting::with('course')->get();
            return response()->json(['meetings' => $meetings]);
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

    // Menampilkan semua jadwal meeting terkait
    public function schedules($meetingId)
    {
        $meeting = Meeting::with('schedules')->find($meetingId);

        if (!$meeting) {
            return response()->json([
                'success' => false,
                'message' => 'Meeting tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'schedules' => $meeting->schedules // Menampilkan jadwal terkait
        ]);
    }

    // Menambahkan jadwal meeting baru
    public function addSchedule(Request $request, $meetingId)
    {
        $validatedData = $request->validate([
            'schedule_time' => 'required|date', // Validasi waktu jadwal meeting
        ]);

        // Mencari meeting berdasarkan ID
        $meeting = Meeting::find($meetingId);

        if (!$meeting) {
            return response()->json([
                'success' => false,
                'message' => 'Meeting tidak ditemukan!'
            ], 404);
        }

        // Menambahkan jadwal meeting baru
        $schedule = new MeetingSchedule([
            'meeting_id' => $meeting->id,
            'schedule_time' => $validatedData['schedule_time']
        ]);

        $meeting->schedules()->save($schedule);

        return response()->json([
            'success' => true,
            'message' => 'Jadwal meeting berhasil dibuat!',
            'schedule' => $schedule
        ]);
    }
}
