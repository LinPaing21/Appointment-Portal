<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Docter;
use App\Models\Patient;
use App\Models\RoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() {
        $docters = DB::table('docters')
                        ->join('users', 'docters.user_id', '=', 'users.id')
                        ->orderBy('users.name', 'asc')
                        ->select('docters.*', 'users.name', 'users.email')
                        ->paginate(10, ['*'], 'dp');

        $patients = DB::table('patients')
                            ->join('users', 'patients.user_id', '=', 'users.id')
                            ->orderBy('users.name', 'asc')
                            ->select('patients.*', 'users.name', 'users.email')
                            ->paginate(10, ['*'], 'dp');

        return view('admin.index', [
            'requests' => RoleRequest::latest()->paginate(10, ['*'], 'rp'),
            'docters' => $docters,
            'patients' => $patients
        ]);
    }

    public function makeDocter($id) {
        $req = RoleRequest::findOrFail($id);
        $user = User::findOrFail($req->user_id);
        if ($user->user_role == 'p') {
            $user->user_role = 'd';
            $user->save();

            $docter = new Docter;
            $docter->user_id = $req->user_id;
            $docter->phone = $req->phone;
            $docter->license = $req->license;
            $docter->speciality = $req->speciality;
            $docter->save();

            Patient::where('user_id', $req->user_id)->delete();

            $req->delete();

            return redirect()->route('admins.home')->with('success', "Successfully change to docter.");
        }

        return redirect()->route('admins.home')->with('success', "Something went wroing.");
    }

    public function requestDestroy($id) {
        RoleRequest::findOrFail($id)->delete();

        return redirect()->route('admins.home')->with('success', "Successfully deny user's request.");
    }

    public function userDestroy($id) {
        User::findOrFail($id)->delete();

        return redirect()->route('admins.home')->with('success', 'Successfully deleted user.');
    }
}
