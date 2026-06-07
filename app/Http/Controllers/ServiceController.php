<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //RAW SQL
        //$servicesRaw = DB::select('SELECT * FROM services');

        //QUERY BUILDER
        //$servicesQueryBuilder = DB::table('services')->get();

        //ELOQUENT ORM
        //$servicesEloquent = Service::all();

        //dd($servicesRaw, $servicesQueryBuilder, $servicesEloquent);

        $allServices = Service::with('category')->get();

        return view('services.index', ['services' => $allServices]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')->get();
        return view('services.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:128',
            'description' => 'required|string',
            'availability'=> 'required|date',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        DB::table('services')->insert([
            'name'        => $request->get('name'),
            'description' => $request->get('description'),
            'availability'=> $request->get('availability'),
            'price'       => $request->get('price'),
            'category_id' => $request->get('category_id'),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()->route('services.index')->with('success', 'Successfully created service.');
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
    public function edit(Service $service)
    {
        $categories = Category::all();
        return view('services.edit', compact('service', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name'        => 'required|string|max:128',
            'description' => 'required|string',
            'availability'=> 'required|date',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $service->name         = $request->get('name');
        $service->description  = $request->get('description');
        $service->availability = $request->get('availability');
        $service->price        = $request->get('price');
        $service->category_id  = $request->get('category_id');
        $service->save();

        return redirect()->route('services.index')->with('success', 'Data layanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        try {
            $service->delete();
            return redirect()->route('services.index')->with('success', 'Data layanan berhasil dihapus.');
        } catch (\PDOException $ex) {
            return redirect()->route('services.index')->with('status', 'Gagal menghapus data! Layanan ini masih digunakan dalam data transaksi.');
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Service::findOrFail($id);
        $categories = Category::all();
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('services.getEditForm', compact('data', 'categories'))->render()
        ), 200);
    }

    public function getEditFormB(Request $request)
    {
        $id = $request->id;
        $data = Service::findOrFail($id);
        $categories = Category::all();
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('services.getEditFormB', compact('data', 'categories'))->render()
        ), 200);
    }

    public function saveDataUpdate(Request $request)
    {
        $request->validate([
            'id'           => 'required|exists:services,id',
            'name'         => 'required|string|max:128',
            'description'  => 'required|string',
            'availability' => 'required|date',
            'price'        => 'required|numeric|min:0',
            'category_id'  => 'required|exists:categories,id',
        ]);

        $id = $request->id;
        $data = Service::findOrFail($id);
        $data->name         = $request->name;
        $data->description  = $request->description;
        $data->availability = $request->availability;
        $data->price        = $request->price;
        $data->category_id  = $request->category_id;
        $data->save();

        $data->load('category');

        return response()->json(array(
            'status' => 'oke',
            'category_name' => $data->category ? $data->category->name : '-',
            'msg' => 'service data is up-to-date !'
        ), 200);
    }

    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Service::findOrFail($id);
        $data->delete();
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'service data is removed !'
        ), 200);
    }
}
