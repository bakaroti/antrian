<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Doktor;
use App\Models\Patient;
use App\Models\Poli;
use App\Models\Poly;
use App\Models\Role;
use App\Models\User;
use App\Models\Websitesetting;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $polis = Poly::all();
        $totalAntrian = Patient::count();
        $totalUser = User::count();
        $totalDoctor = Doctor::count();
        $patients = Patient::all()->take(3);
        $link = Websitesetting::all()->first();
        return view('admin.dashboard', compact('polis', 'link', 'patients', 'totalAntrian', 'totalUser', 'totalDoctor'));
    }


    public function viewAdmin()
    {
        $datas = Admin::paginate(10);
        return view('admin.admin.index', compact('datas'));
    }
    public function createAdmin()
    {

        return view('admin.admin.create');
    }

    public function storeAdmin(Request $request)
    {
        try {
            $attributes = request()->validate([
                'name' => 'required',
                'username' => 'required|max:255|min:2',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:5|max:255',
            ]);
            $user = Admin::create($attributes);

            return redirect()->route('setAdmin')->with('success', 'Data Berhasil Masuk');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: Failed to Save data.');
        }
    }

    public function deleteAdmin(Request $request, $id)
    {
        try {
            $admin = Admin::findOrFail($id);
            $admin->delete();
            return redirect()->route('setAdmin')->with('success', 'Data User berhasil didelete.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: Failed to update Data.');
        }
    }

    //USER CONTROLLER
    public function viewUser()
    {
        $datass = User::paginate(10);
        $datas = User::orderByDesc('role')->paginate(10);
        return view('admin.user.index', compact('datas'));
    }

    public function createUser()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function storeUser(Request $request)
    {
        try {
            $attributes = request()->validate([
                'username' => 'required|max:255|min:2',
                'email' => 'required|email|max:255|unique:users,email',
                'role' => 'required',
                'password' => 'required|min:5|max:255',
                'address' => 'required',
                'country' => 'required',
                'city' => 'required',
                'postal' => 'required',
                'firstname' => 'required',
                'lastname' => 'required',
                ''
            ]);
            $user = User::create($attributes);

            return redirect()->route('setUser')->with('success', 'Data Berhasil Masuk');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: Failed to Save data.');
        }
    }
    public function detailsUser($id)
    {
        $datas = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.user.edit', compact('datas', 'roles'));
    }

    public function updateUser(Request $request, $id)
    {
        try {
            $request->validate([
                'username' => 'required',
                'email' => 'required|email',
                'firstname' => 'required',
                'lastname' => 'required',
                'address' => '', // 'address' is not required for updating
                'country' => '', // 'country' is not required for updating
                'city' => '', // 'city' is not required for updating
                'postal' => '', // 'postal' is not required for updating
            ]);

            // Find the user by their ID
            $user = User::findOrFail($id);

            // Update the user's data
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->address = $request->input('address');
            $user->country = $request->input('country');
            $user->city = $request->input('city');
            $user->postal = $request->input('postal');
            $user->save();

            return redirect()->route('setUser')->with('success', 'Data User berhasil diperbarui.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: Failed to update data.');
        }
    }

    public function deleteUser(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->delete();
            return redirect()->route('setUser')->with('success', 'Data User berhasil didelete.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: Failed to update Data.');
        }
    }


    //DOKTOR CONTROLLER
    public function viewDoktor()
    {
        $datas = Doctor::paginate(10);
        return view('admin.doktor.index', compact('datas'));
    }

    public function createDoktor()
    {

        $polies = Poly::all();
        $users = User::all();
        return view('admin.doktor.create', compact('polies', 'users'));
    }

    public function storeDoktor(Request $request)
    {
        try {
            $attributes = request()->validate([
                'user_id' => 'required',
                'poly_id' => 'required',
            ]);
            $doktor = Doctor::create($attributes);

            // dd($doktor);
            return redirect()->route('setDoktor')->with('success', 'Data Berhasil Masuk');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: Failed to Save data.');
        }
    }
    public function detailsDoktor($id)
    {
        $datas = Doctor::findOrFail($id);
        $polies = Poly::all();
        $users = User::all();
        return view('admin.doktor.edit', compact('datas',));
    }

    public function updateDoktor(Request $request, $id)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'poly_id' => 'required',
            ]);

            // Find the user by their ID
            $doktor = Doctor::findOrFail($id);

            // Update the user's data
            $doktor->username = $request->input('user_id');
            $doktor->email = $request->input('poly_id');
            $doktor->save();

            return redirect()->route('setDoktor')->with('success', 'Data User berhasil diperbarui.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: Failed to update data.');
        }
    }

    public function deleteDoktor(Request $request, $id)
    {
        try {
            $user = Doctor::findOrFail($id);

            $user->delete();
            return redirect()->route('setDoktor')->with('success', 'Data User berhasil didelete.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: Failed to update Data.');
        }
    }

    //POLI
    public function viewPoli()
    {
        $datas = Poly::paginate(10);
        return view('admin.poli.index', compact('datas'));
    }

    public function createPoli()
    {

        return view('admin.poli.create');
    }

    public function storePoli(Request $request)
    {
        try {
            $attributes = request()->validate([
                'name' => 'required|max:255',
                'initial' => 'required',
            ]);
            $poli = Poly::create($attributes);

            return redirect()->route('setPoli')->with('success', 'Data Poli Berhasil Masuk');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: Failed to Save data.');
        }
    }
    public function detailsPoli($id)
    {
        $datas = Poly::findOrFail($id);
        return view('admin.poli.edit', compact('datas'));
    }

    public function updatePoli(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'initial' => 'required',
            ]);

            // Find the user by their ID
            $poli = Poly::findOrFail($id);

            // Update the user's data
            $poli->username = $request->input('name');
            $poli->email = $request->input('initial');
            $poli->save();

            return redirect()->route('setPoli')->with('success', 'Data Poli berhasil diperbarui.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: Failed to update data.');
        }
    }

    public function deletePoli(Request $request, $id)
    {
        try {
            $poli = Poly::findOrFail($id);

            $poli->delete();
            return redirect()->route('setPoli')->with('success', 'Data Poli berhasil didelete.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: Failed to update Data.');
        }
    }

    public function setVidMonitor(Request $request)
    {
        try {
            $request->validate([
                'monitor' => 'required|max:255',
            ]);

            $websiteSetting = Websitesetting::first();
            $websiteSetting->link_youtube = $request->input('monitor'); // Menggunakan input 'link_youtube'
            $websiteSetting->save();

            return redirect()->route('home')->with('success', 'Link Video Monitor berhasil diperbarui.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error: Failed to update data.');
        }
    }
}
