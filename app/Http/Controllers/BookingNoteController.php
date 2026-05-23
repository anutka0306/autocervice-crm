<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingNote;
use Illuminate\Http\Request;

class BookingNoteController extends Controller
{
    /**
     * @param Request $request
     * @param Booking $booking
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'text' => ['required', 'string'],
        ]);

        $booking->notes()->create([
            'text' => $validated['text'],
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    /**
     * @param BookingNote $note
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BookingNote $note)
    {
        $note->delete();

        return back();
    }
}
