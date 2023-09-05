<?php

namespace App\Http\Controllers;

use App\Events\DoctorAntrian;
use App\Events\NomorEvent;
use App\Models\Patient;
use App\Models\polie;
use App\Models\Poly;
use Illuminate\Http\Request;

class tiketAjaxControllet extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $polie = Poly::all();
        return response()->json($polie);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // var_dump($request);
        // die;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function coba(Request $request){
        $nomorAkhir = Patient::where('poly_initial', $request->poli)->latest()->first();

        if(!$nomorAkhir){
            $nomorBaru = 1;
        }else{
            $nomorBaru = $nomorAkhir->queue_number + 1;
            // $nomorAkhir = (int) substr($nomorAkhir, 1);
        }

        // $nomorAkhir += 1;
        // $initial = Poly::find($request->input('poli'))->initial;
        // $nomorBaru = $initial . ($nomorAkhir . "");

        Patient::create([
            'poly_initial' => $request->poli,
            'queue_number' => $nomorBaru,
            'antrian' => $request->poli . $nomorBaru,
        ]);
        // echo $request;
        // dd($request->input('poli'));
        $newPatient = Patient::where('poly_initial', $request->poli)->get();

        event(new DoctorAntrian($newPatient));

        return response()->json(['nomor' => $nomorBaru]);
    }
}
