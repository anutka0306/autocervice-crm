<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    public function index()
    {
        $notes = Note::with('user')
            ->latest()
            ->get();

        return view('notes._list', compact('notes'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => ['required', 'string', 'max:1000'],
        ]);

        Note::create([
            'user_id' => auth()->id(),
            'text' => $validated['text'],
        ]);

        return back();
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $general_note)
    {
        $general_note->delete();

        return back();
    }
}
