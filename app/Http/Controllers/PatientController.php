<?php

namespace App\Http\Controllers;

use App\Events\DoctorAntrian;
use App\Events\ShowNomor;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    //
    public function store(Request $request)
    {

        $antrian_akhir = Patient::where('poly_initial', $request->poli)->latest()->first();


        if (!$antrian_akhir) {
            $antrian_baru = 1;
        } else {
            $antrian_baru = $antrian_akhir->queue_number + 1;
        }



        Patient::create([
            'poly_initial' => $request->poli,
            'queue_number' => $antrian_baru,
            'antrian' => $request->poli . $antrian_baru,
        ]);

        $patient = Patient::where('poly_initial', $request->poli)->get();

        event(new DoctorAntrian($patient));

        return response()->json([
            'data' => $request->poli . $antrian_baru
            // 'data' => $antrian_baru
            // 'data' => $request->poli
        ]);


        // dd($request);
    }

    public function testing()
    {
        event(new ShowNomor('testing'));

        return response()->json(['data' => 'test dijalankan']);
    }
}
