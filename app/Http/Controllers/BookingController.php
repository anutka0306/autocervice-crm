<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\BookingService;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with([
            'client',
            'master',
        ])
            ->latest('start_at')
            ->paginate(20);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::orderBy('name')->get();

        $masters = User::where('role', 'master')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $statuses = [
            'new' => 'Новый клиент',
            'in_progress' => 'В работе',
            'done' => 'Готова',
        ];

        return view('bookings.create', compact(
            'clients',
            'masters',
            'statuses'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, BookingService $service)
    {
        $validated = $request->validate([
            'client_id' => ['nullable', 'exists:clients,id'],
            'client_name' => ['nullable', 'string'],
            'client_lastname' => ['nullable', 'string'],
            'client_phone' => ['nullable', 'string'],

            'master_id' => ['required', 'exists:users,id'],
            'status' => ['required'],
            'car_brand' => ['nullable', 'string'],
            'car_model' => ['nullable', 'string'],
            'start_at' => ['required', 'date'],
            'duration' => ['required', 'integer', 'min:15'],
        ]);

        try {
            $service->create($validated);

            return redirect()
                ->route('calendar.index')
                ->with('success', 'Запись создана');

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->withErrors([
                    'general' => $e->getMessage(),
                ]);
        }
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
    public function edit(Booking $booking)
    {
        $clients = Client::orderBy('name')->get();

        $masters = User::where('role', 'master')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $statuses = [
            'new' => 'Новый клиент',
            'in_progress' => 'В работе',
            'done' => 'Готова',
        ];

        return view('bookings.edit', compact(
            'booking',
            'clients',
            'masters',
            'statuses'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'client_id' => ['required', 'exists:clients,id'],

            'master_id' => ['required', 'exists:users,id'],

            'status' => ['required'],

            'car_brand' => ['nullable', 'string'],
            'car_model' => ['nullable', 'string'],

            'start_at' => ['required', 'date'],

            'duration' => ['required', 'integer', 'min:15'],
        ]);

        $startAt = Carbon::parse($validated['start_at']);

        $duration = (int) $validated['duration'];

        $endAt = $startAt->copy()
            ->addMinutes($duration);

        $hasConflict = Booking::where('master_id', $validated['master_id'])

            ->where('id', '!=', $booking->id)

            ->where(function ($query) use ($startAt, $endAt) {

                $query
                    ->where('start_at', '<', $endAt)
                    ->where('end_at', '>', $startAt);
            })

            ->exists();

        if ($hasConflict) {

            return back()
                ->withInput()
                ->withErrors([
                    'start_at' => 'У мастера уже есть запись на это время',
                ]);
        }

        $booking->update([
            'client_id' => $validated['client_id'],

            'master_id' => $validated['master_id'],

            'status' => $validated['status'],

            'car_brand' => $validated['car_brand'],
            'car_model' => $validated['car_model'],

            'start_at' => $startAt,
            'end_at' => $endAt,

            'updated_by' => auth()->id(),
        ]);

        return redirect()
            ->route('calendar.index')
            ->with('success', 'Запись обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Booking $booking)
    {
        $date = $request->date;
        $booking->delete();

        return redirect()
            ->route('calendar.index', [
                'date' => $date,
            ])
            ->with('success', 'Запись удалена');
    }

    public function sidebar(Booking $booking)
    {
        $booking->load([
            'notes.user',
        ]);

        return view('bookings._sidebar', [
            'booking' => $booking,
        ]);
    }
}
