<?php

namespace App\Http\Controllers;

use App\Events\DoctorAntrian;
use App\Events\NomorEvent;
use App\Events\ShowNomor;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\polie;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DoktorController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $doctors = Doctor::where('user_id', $id)->first();
        return view('mainDoktor.index' , compact('doctors'));
        // $poly_id = $doctor->poly_id;
        // $patients2 = Patient::where('poly_id', $poly_id)->get();
        // $data = $patients2;
        // return DataTables::of($data)->make(true);
    }

    // public function testing()
    // {
    //     $newPatient = Patient::take(4)->get();
    //     event(new NomorEvent($newPatient));
    // }

    public function getAntrian(Patient $patient, Request $request){
        $doctor = Doctor::find($request->doctor_id);
        $doctor->poly->update(['status' => 1]);
        // $patient->update(['status' => 1]);
        event(new ShowNomor($patient));
        return response()->json(['data' => $patient->antrian]);
        // ddd();
    }

    public function deleteAntrian(Patient $patient, Request $request){
        $doctor = Doctor::find($request->doctor_id);
        $doctor->poly->update(['status' => 0]);
        Patient::destroy($patient->id);
        $patient = ['poly_initial' => $patient->poly_initial, 'value' => '-'];
        event(new ShowNomor($patient));
        $patient = Patient::where('poly_initial', $doctor->poly->initial)->get();
        event(new DoctorAntrian($patient));
        return response()->json(['data' => '-']);
    }

    public function nextAntrian(Patient $patient, Request $request){
        $doctor = Doctor::find($request->doctor_id);
        Patient::destroy($patient->id);
        $patient = Patient::where('poly_initial', $doctor->poly->initial)->get();
        // $patient[0]->update(['status' => 1]);
        event(new ShowNomor($patient[0]));
        event(new DoctorAntrian($patient));
        return response()->json(['data' => $patient[0]->antrian]);
    }

    public function monitor(Request $request)
    {
        $nilai = $request->input('nilai');
        return response()->json($nilai);
    }
}
