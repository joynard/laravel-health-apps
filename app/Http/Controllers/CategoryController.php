<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allCategories = DB::table('categories')->get();

        return view('categories.index', ['categories' => $allCategories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:128',
        ]);

        $category = new Category();
        $category->name = $request->get('name');
        
        if ($request->has('image') && $request->filled('image')) {
            $category->image = $request->get('image');
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Successfully created data.');
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
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:128',
        ]);

        $category->name = $request->get('name');

        if ($request->has('image') && $request->filled('image')) {
            $category->image = $request->get('image');
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Data kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Data kategori berhasil dihapus.');
        } catch (\PDOException $ex) {
            return redirect()->route('categories.index')->with('status', 'Gagal menghapus data! Kategori ini masih memiliki data layanan yang terkait.');
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Category::find($id);
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('categories.getEditForm', compact('data'))->render()
        ), 200);
    }

    public function getEditFormB(Request $request)
    {
        $id = $request->id;
        $data = Category::find($id);
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('categories.getEditFormB', compact('data'))->render()
        ), 200);
    }

    public function saveDataUpdate(Request $request)
    {
        $id = $request->id;
        $data = Category::find($id);
        $data->name = $request->name;
        $data->save();
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'category data is up-to-date !'
        ), 200);
    }

    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Category::find($id);
        $data->delete();
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'category data is removed !'
        ), 200);
    }
}
