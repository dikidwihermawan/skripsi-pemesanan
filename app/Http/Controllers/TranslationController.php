<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function index()
    {
        return view('translation.index');
    }
    public function read()
    {
        $translation = Translation::all();
        return view('translation.table', compact('translation'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required', 'numeric'],
            'type' => ['required'],
            'process' => ['required', 'numeric'],
        ]);
        Translation::create($request->all());
        return response()->json(['success' => 'Data added Successfully!']);
    }
    public function edit($id)
    {
        $translation = Translation::find($id);
        return response()->json($translation);
    }
    public function update(Request $request, $id)
    {
        $translation = Translation::find($id);
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required', 'numeric'],
            'type' => ['required'],
            'process' => ['required', 'numeric'],
        ]);
        $translation->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'type' => $request->type,
            'process' => $request->process,
        ]);
        return response()->json(['success' => 'Data update Successfully!']);
    }
    public function destroy($id)
    {
        $translation = Translation::find($id);
        $translation->delete();
        return response()->json($translation);
    }
}
