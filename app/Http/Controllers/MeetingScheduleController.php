<?php

namespace App\Http\Controllers;

use App\Models\MeetingSchedule;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeetingScheduleController extends Controller
{
    // Menampilkan daftar MeetingSchedule
    public function index()
    {
        // Mengambil semua MeetingSchedule dengan relasi Meeting
        $schedules = MeetingSchedule::with('meeting')->get();

        // Mengembalikan data dalam format JSON
        return response()->json([
            'schedules' => $schedules
        ]);
    }

    // Menambahkan MeetingSchedule baru
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'meeting_id' => 'required|exists:meetings,id',
            'schedule_time' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal!',
                'errors' => $validator->errors()
            ], 422);
        }

        // Menyimpan data MeetingSchedule baru
        $schedule = MeetingSchedule::create([
            'meeting_id' => $request->meeting_id,
            'schedule_time' => $request->schedule_time
        ]);

        // Mengembalikan respons sukses
        return response()->json([
            'success' => true,
            'message' => 'Jadwal meeting berhasil dibuat!',
            'schedule' => $schedule
        ]);
    }

    // Menampilkan detail MeetingSchedule
    public function show($id)
    {
        // Mencari MeetingSchedule berdasarkan ID
        $schedule = MeetingSchedule::with('meeting')->find($id);

        if (!$schedule) {
            return response()->json([
                'success' => false,
                'message' => 'Meeting schedule tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'schedule' => $schedule
        ]);
    }

    // Mengupdate MeetingSchedule
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'meeting_id' => 'required|exists:meetings,id',
            'schedule_time' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal!',
                'errors' => $validator->errors()
            ], 422);
        }

        // Cari MeetingSchedule berdasarkan ID
        $schedule = MeetingSchedule::find($id);
        if (!$schedule) {
            return response()->json([
                'success' => false,
                'message' => 'Meeting schedule tidak ditemukan!'
            ], 404);
        }

        // Update MeetingSchedule
        $schedule->update([
            'meeting_id' => $request->meeting_id,
            'schedule_time' => $request->schedule_time
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Jadwal meeting berhasil diperbarui!',
            'schedule' => $schedule
        ]);
    }

    // Menghapus MeetingSchedule
    public function destroy($id)
    {
        // Cari MeetingSchedule berdasarkan ID
        $schedule = MeetingSchedule::find($id);
        if (!$schedule) {
            return response()->json([
                'success' => false,
                'message' => 'Meeting schedule tidak ditemukan!'
            ], 404);
        }

        // Hapus MeetingSchedule
        $schedule->delete();

        return response()->json([
            'success' => true,
            'message' => 'Jadwal meeting berhasil dihapus!'
        ]);
    }
}
