<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // Patient Section
    public function showBookings($id) { //Patient's bookings
        $schedules = Schedule::with(['docter'])
                                ->where('patient_id', $id)
                                ->where('start_time', '>', now())
                                ->paginate(6);
        return view('patients.myBookings', [
            'schedules' => $schedules,
            'patient_id' => $id
        ]);
    }

    public function showMyHistory($id) {
        return view('patients.p_history', [
            'histories' => $this->getHistory($id),
            'patient_id' => $id,
        ]);
    }

    // Docter Section
    public function showPatientHistory($id) {
        return view('docters.d_history', [
            'histories' => $this->getHistory($id),
        ]);
    }

    public function showAppointments($id) { // Docter's Appointment
        $bookings = Schedule::with(['patient'])->where('docter_id', '=', $id)
                        ->where('start_time', '>', now())
                        ->where('accept', false)
                        ->paginate(4);

        return view('docters.myAppointments', [
            "bookings" => $bookings,
            "docter_id" => $id,
        ]);
    }

    public function showSessions($id) { // Docter's Appointment
        $sessions = Schedule::with(['patient'])->where('docter_id', '=', $id)
                        ->where('start_time', '>', now())
                        ->where('accept', true)
                        ->paginate(4);

        return view('docters.mySessions', [
            "sessions" => $sessions,
            "docter_id" => $id,
        ]);
    }

    // other function
    private function getHistory($id) {
        return History::where('patient_id', $id)->paginate(10);
    }
}
