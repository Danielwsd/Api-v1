<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Multimedia;
use Illuminate\Http\Request;

class MultimediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $multimedias=Multimedia::filter()->sort()->get();
        return $multimedias;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'url' => 'required|max:255',
        ]);

        $multimedia=Multimedia::create($request->all());

        return $multimedia;
    }

    /**
     * Display the specified resource.
     */
    public function show(Multimedia $multimedia)
    {
        //
        $multimedia = Multimedia::included()->findOrFail($multimedia);
        return $multimedia;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Multimedia $multimedia)
    {
        //
        $request->validate([
            'url' => 'required|max:255',
            
        ]);

        $multimedia->update($request->all());

        return $multimedia;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Multimedia $multimedia)
    {
        //
        $multimedia->delete();
        return $multimedia;
    }
}
