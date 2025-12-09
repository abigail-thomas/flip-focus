<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\StudySet;
use App\Models\Flashcard;
use Illuminate\Http\Request;

class ProfileController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $studySets = $user->studySets()->orderBy('title')->get(); // i think i wanna order by rating eventually 
        // return view('components.index.featuredcards', ['sets' => $sets]);
        $savedSets = $user->savedSets()->orderBy('title')->get();
        return view('profile', [
            'user' => $user,
            'studySets' => $studySets,
            'savedSets' => $savedSets,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
}
