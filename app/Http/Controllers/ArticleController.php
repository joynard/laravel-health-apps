<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Doctor;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allArticles = Article::with('doctor')->get();
        $allDoctors = Doctor::all();
        return view('articles.index', [
            'articles' => $allArticles,
            'doctors' => $allDoctors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = Doctor::all();
        return view('articles.create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id'   => 'required|exists:doctors,id',
            'title'       => 'required|string|max:128',
            'content'     => 'required|string',
            'status'      => 'required|in:draft,published',
            'views_count' => 'required|integer|min:0',
        ]);

        $article = new Article();
        $article->doctor_id = $request->get('doctor_id');
        $article->title = $request->get('title');
        $article->content = $request->get('content');
        $article->status = $request->get('status');
        $article->views_count = $request->get('views_count');
        $article->save();

        return redirect()->route('articles.index')->with('success', 'Successfully created article.');
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
    public function edit(Article $article)
    {
        $doctors = Doctor::all();
        return view('articles.edit', compact('article', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'doctor_id'   => 'required|exists:doctors,id',
            'title'       => 'required|string|max:128',
            'content'     => 'required|string',
            'status'      => 'required|in:draft,published',
            'views_count' => 'required|integer|min:0',
        ]);

        $article->doctor_id = $request->get('doctor_id');
        $article->title = $request->get('title');
        $article->content = $request->get('content');
        $article->status = $request->get('status');
        $article->views_count = $request->get('views_count');
        $article->save();

        return redirect()->route('articles.index')->with('success', 'Data artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Data artikel berhasil dihapus.');
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Article::findOrFail($id);
        $doctors = Doctor::all();
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('articles.getEditForm', compact('data', 'doctors'))->render()
        ), 200);
    }

    public function getEditFormB(Request $request)
    {
        $id = $request->id;
        $data = Article::findOrFail($id);
        $doctors = Doctor::all();
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('articles.getEditFormB', compact('data', 'doctors'))->render()
        ), 200);
    }

    public function saveDataUpdate(Request $request)
    {
        $request->validate([
            'id'          => 'required|exists:articles,id',
            'doctor_id'   => 'required|exists:doctors,id',
            'title'       => 'required|string|max:128',
            'content'     => 'required|string',
            'status'      => 'required|in:draft,published',
            'views_count' => 'required|integer|min:0',
        ]);

        $id = $request->id;
        $data = Article::findOrFail($id);
        $data->doctor_id = $request->doctor_id;
        $data->title = $request->title;
        $data->content = $request->content;
        $data->status = $request->status;
        $data->views_count = $request->views_count;
        $data->save();
        
        // Load relation for front-end presentation
        $data->load('doctor');

        return response()->json(array(
            'status' => 'oke',
            'doctor_name' => $data->doctor->name,
            'msg' => 'article data is up-to-date !'
        ), 200);
    }

    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Article::findOrFail($id);
        $data->delete();
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'article data is removed !'
        ), 200);
    }
}
