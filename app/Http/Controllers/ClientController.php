<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::latest()->paginate(20);

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::latest()->paginate(20);
        return view('clients.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'phone' => ['required', 'max:12', 'unique:clients,phone'],
        ]);

        $validated['phone'] = $this->normalizePhone($request->phone);

        Client::create($validated);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Клиент создан');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'phone' => [
                'required',
                'max:12',
                'unique:clients,phone,' . $client->id,
            ],
        ]);

        $validated['phone'] = $this->normalizePhone($request->phone);

        $client->update($validated);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Клиент обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function normalizePhone(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone);

        if (str_starts_with($phone, '8')) {
            $phone = '7' . substr($phone, 1);
        }

        if (strlen($phone) === 10) {
            $phone = '7' . $phone;
        }

        return $phone;
    }
}
