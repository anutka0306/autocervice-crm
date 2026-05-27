<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Note;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $date = Carbon::parse(
            $request->get('date', now())
        );

        $masters = User::query()
            ->where('role', 'master')
            ->get();

        $bookings = Booking::with(['client', 'master'])
            ->whereDate('start_at', $date)
            ->orderBy('start_at')
            ->get();

        $notes = Note::latest()->get();


        return view('calendar.index', compact(
            'bookings',
            'masters',
            'date',
            'notes'
        ));
    }


    /**
     * @param $time
     * @return float
     */
    private function getTop($time)
    {
        $startDay = \Carbon\Carbon::parse($time)->startOfDay()->addHours(8);

        $minutes = $startDay->diffInMinutes($time);

        return $minutes;
    }

    /**
     * @param $start
     * @param $end
     * @return float
     */
    private function getHeight($start, $end)
    {
        return \Carbon\Carbon::parse($start)
            ->diffInMinutes($end);
    }
}
