<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\StudySet;
use App\Models\Flashcard;

class StudySetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sets = StudySet::orderBy('title')->paginate(3); // i think i wanna order by rating eventually 
        return view('components.index.featuredcards', ['sets' => $sets]);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(StudySet $studySet)
    {
        //  only have 5 sets load
        $studySet->load('flashcards');

        // increase the number of studies by 1, only do when they reach the end of study set
        // $studySet->increment('num_studies');


        return view('study.show', ['set' => $studySet]);
    }

    public function browse() {
        $sets = StudySet::orderBy('title')->get();

        return view('study.browse', ['sets' => $sets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('study.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'title'=>'required|string|max:255',
            'subject'=> 'required',
            'description'=>'required|string|max:2000',


            'term' => 'required|array|min:1',
            'term.*' => 'required|string|max:255',

            'definition' => 'required|array|min:1',
            'definition.*' => 'required|string|max:2000',
        ]);

        // StudySet::create($validated);

        // validated the data inpu tby user,
        // now assign proper data to study set as a whole
        // or individual flashcard
        $studySet = StudySet::create([
            'title' => $validated['title'],
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'user_id'=> Auth::id(),
            'author'=> Auth::user()->name,
        ]);

       /* $studySet->flashcards()->create([
            'term' => $validated['term'],
            'definition' => $validated['definition'],
        ]);
*/
    /* for multiple flashacards maybe*/
        foreach ($validated['term'] as $i => $term) {
            $studySet->flashcards()->create([
                'term' => $term,
                'definition' => $validated['definition'][$i],
            ]);
        }

        return redirect()->route('study.show', $studySet->id)
            ->with('success', 'Study Set created successfully!');;
    }

    // saving sets to profile
    public function saveSet(StudySet $set) {
        $user = Auth::user();
        if ($user->savedSets()->where('study_set_id', $set->id)->exists()) {
            $user->savedSets()->detach($set->id);
            $saved = false;
        }
        else {
            $user->savedSets()->attach($set->id);
            $saved = true;
        }
        
        return response()->json(['saved' => $saved]);
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
    public function destroy(StudySet $studySet)
    {
        //
        $studySet->delete();
            //dd('DESTROY HIT', $studySet);  // <--- add this

        return redirect()->route('profile')->with('success', 'Set deleted');
    }

    // search in the browse blade
    public function search (Request $req, StudySet $sets) {

        // get the search term from search bar
        $query = $req->input('search-bar');

        // fetch sets from model
        $sets = StudySet::where('title', 'LIKE', "%{$query}%")->get();
        // $sets = StudySet::all();

        // return view for blade i need, fragment study list
        return view('study.browse', ['sets' => $sets])
        ->fragment('study-search');

    }

    // incrmeneting
    public function incrementNumStudies(StudySet $studySet) {
        $studySet->increment('num_studies');
    }

}
