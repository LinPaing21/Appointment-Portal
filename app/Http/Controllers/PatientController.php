<?php

namespace App\Http\Controllers;

use App\Models\Docter;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\RoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index() {
        try {
            $patient = Patient::select('id')->where('user_id', '=', auth()->user()->id)->get()[0];

            return view('patients.index', [
                "docters" => Docter::filter(request('name'))->paginate(9),
                "patient_id" => $patient->id
            ]);
        } catch (\Throwable $th) {
            Auth::logout();

            return redirect()->route('login');
        }
    }

    public function create() {
        $docter = Docter::with(['schedules'])->findOrFail(request('id'));
        return view('patients.createAppointment', [
            'docter' => $docter
        ]);
    }

    public function store() {
        $data = $this->validateSchedule();

        $patient = Patient::select('id')->where('user_id', '=', auth()->user()->id)->get()[0];

        $data['patient_id'] = $patient->id;
        Schedule::create($data);
        return redirect()->route('patients.home')
                        ->with('success', 'You successfully create an appointment. Please wait docter response');
    }

    public function edit() {
        $patient = Patient::findOrFail(request('p_id'));
        if (auth()->user()->id == $patient->user_id) {
            return view('patients.editAppointment', [
                    'schedule' => Schedule::findOrFail(request('s_id')),
                    'patient_id' => $patient->id
                ]);
        }else {
            abort(403, 'Unauthorized!');
        }
    }

    public function update() {
        $patient = Patient::findOrFail(request('p_id'));
        if (auth()->user()->id == $patient->user_id) {
            $data = $this->validateSchedule();
            $schedule = Schedule::findOrFail(request('s_id'));
            $schedule->update($data);

            return redirect()->route('patients.showbookings', $patient->id)
                            ->with('success', 'Your Appointment is successfully updated. Please wait docter response');
        }else {
            abort(403, 'Unauthorized!');
        }
    }

    public function destroy() {
        $patient = Patient::findOrFail(request('p_id'));
        if (auth()->user()->id == $patient->user_id) {
            $schedule = Schedule::findOrFail(request('s_id'));
            $schedule->delete();

            return redirect()->route('patients.showbookings', $patient->id)
                            ->with('success', 'Your Appointment is Deleted.');
        }else {
            abort(403, 'Unauthorized!');
        }
    }

    public function requestDocterRole() {
        return view('patients.makeDocter');
    }

    public function addRequest() {
        $data = request()->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'min:7', 'max:20'],
            'license' => ['required', 'string', 'max:10'],
            'speciality' => ['required', 'string']
        ]);

        $data['name'] = auth()->user()->name;
        $data['user_id'] = auth()->user()->id;
        RoleRequest::create($data);

        return redirect()->route('patients.home')->with('success', 'You successfully create a request. Please wait respone.');
    }

    public function validateSchedule() {
        $v_data = request()->validate([
            'docter_id' => 'required',
            'title' => 'required',
            'start_time' => 'required|date|datetime_greater_than_now',
        ]);

        $v_data['start_time'] = str_replace('T', ' ', request('start_time'));

        return $v_data;
    }
}
