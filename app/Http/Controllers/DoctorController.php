<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allDoctors = Doctor::all();
        return view('doctors.index', ['doctors' => $allDoctors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:128',
            'email'            => 'required|email|unique:doctors,email',
            'status'           => 'required|in:active,inactive',
            'consultation_fee' => 'required|numeric|min:0',
        ]);

        $doctor = new Doctor();
        $doctor->name = $request->get('name');
        $doctor->email = $request->get('email');
        $doctor->status = $request->get('status');
        $doctor->consultation_fee = $request->get('consultation_fee');
        $doctor->save();

        return redirect()->route('doctors.index')->with('success', 'Successfully created doctor.');
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
    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name'             => 'required|string|max:128',
            'email'            => 'required|email|unique:doctors,email,' . $doctor->id,
            'status'           => 'required|in:active,inactive',
            'consultation_fee' => 'required|numeric|min:0',
        ]);

        $doctor->name = $request->get('name');
        $doctor->email = $request->get('email');
        $doctor->status = $request->get('status');
        $doctor->consultation_fee = $request->get('consultation_fee');
        $doctor->save();

        return redirect()->route('doctors.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        try {
            $doctor->delete();
            return redirect()->route('doctors.index')->with('success', 'Data dokter berhasil dihapus.');
        } catch (\PDOException $ex) {
            return redirect()->route('doctors.index')->with('status', 'Gagal menghapus data! Dokter ini mungkin memiliki data artikel atau transaksi terkait.');
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Doctor::findOrFail($id);
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('doctors.getEditForm', compact('data'))->render()
        ), 200);
    }

    public function getEditFormB(Request $request)
    {
        $id = $request->id;
        $data = Doctor::findOrFail($id);
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('doctors.getEditFormB', compact('data'))->render()
        ), 200);
    }

    public function saveDataUpdate(Request $request)
    {
        $request->validate([
            'id'               => 'required|exists:doctors,id',
            'name'             => 'required|string|max:128',
            'email'            => 'required|email|unique:doctors,email,' . $request->id,
            'status'           => 'required|in:active,inactive',
            'consultation_fee' => 'required|numeric|min:0',
        ]);

        $id = $request->id;
        $data = Doctor::findOrFail($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->status = $request->status;
        $data->consultation_fee = $request->consultation_fee;
        $data->save();
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'doctor data is up-to-date !'
        ), 200);
    }

    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Doctor::findOrFail($id);
        $data->delete();
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'doctor data is removed !'
        ), 200);
    }
}
