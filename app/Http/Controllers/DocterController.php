<?php

namespace App\Http\Controllers;

use App\Models\Docter;
use App\Models\Schedule;
use Illuminate\Http\Request;

class DocterController extends Controller
{
    public function index() {
        $docter = Docter::select('id')->where('user_id', '=', auth()->user()->id)->get()[0];
        $schedules = Schedule::select('title', 'start_time')
                                    ->where('docter_id', '=', $docter->id)
                                    ->where('accept', true)
                                    ->get();

        $bookings = Schedule::select('id')->where('docter_id', '=', $docter->id)
                        ->where('accept', false)
                        ->get();

        return view('docters.index', [
            "docter_id" => $docter->id,
            "schedules" => $schedules,
            "booking_count" => $bookings->count()
        ]);
    }

    public function update() {
        $docter = Docter::findOrFail(request('d_id'));
        if (auth()->user()->id == $docter->user_id) {
            $schedule = Schedule::findOrFail(request('s_id'));
            $schedule->update([
                "accept" => true
            ]);

            return redirect()->route('docters.showAppointments', $docter->id)
                            ->with('success', "You accept the booking. Have a good time at {$schedule->start_time}");
        }else {
            abort(403, 'Unauthorized!');
        }
    }

    public function destroy() {
        $docter = Docter::findOrFail(request('d_id'));
        if (auth()->user()->id == $docter->user_id) {
            $schedule = Schedule::findOrFail(request('s_id'));
            $schedule->delete();

            return redirect()->route('docters.showAppointments', $docter->id)
                            ->with('success', 'You Rejected an Appointment.');
        }else {
            abort(403, 'Unauthorized!');
        }
    }
}
