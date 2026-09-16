<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Talent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(Request $request): View
    {
        $query = Client::with('talent');

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $pipeline = [
            'lead' => Client::where('status', 'lead')->count(),
            'negotiation' => Client::where('status', 'negotiation')->count(),
            'active' => Client::where('status', 'active')->count(),
            'completed' => Client::where('status', 'completed')->count(),
            'lead_value' => Client::where('status', 'lead')->sum('deal_value'),
            'negotiation_value' => Client::where('status', 'negotiation')->sum('deal_value'),
            'active_value' => Client::where('status', 'active')->sum('deal_value'),
            'completed_value' => Client::where('status', 'completed')->sum('deal_value'),
        ];

        return view('dashboard.clients.index', [
            'clients' => $query->latest()->paginate(12),
            'pipeline' => $pipeline,
            'talents' => Talent::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function create(): View
    {
        return view('dashboard.clients.create', [
            'talents' => Talent::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:30',
            'company' => 'nullable|string|max:255',
            'status' => 'required|in:lead,negotiation,active,completed,cancelled',
            'type' => 'required|in:sponsorship,commission,talent-hire,event,merch,other',
            'deal_value' => 'nullable|numeric|min:0',
            'talent_id' => 'nullable|exists:talents,id',
            'deadline' => 'nullable|date',
            'notes' => 'nullable|string|max:2000',
        ]);

        $validated['user_id'] = auth()->id();

        Client::create($validated);

        return redirect()->route('clients.index')->with('success', 'Client berhasil ditambahkan!');
    }

    public function show(Client $client): View
    {
        $client->load('talent');

        return view('dashboard.clients.show', compact('client'));
    }

    public function edit(Client $client): View
    {
        return view('dashboard.clients.edit', [
            'client' => $client,
            'talents' => Talent::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(Request $request, Client $client): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:lead,negotiation,active,completed,cancelled',
            'deal_value' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:2000',
        ]);

        $client->update($validated);

        return redirect()->route('clients.show', $client)->with('success', 'Client berhasil diupdate!');
    }

    public function destroy(Client $client): RedirectResponse
    {
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client berhasil dihapus.');
    }
}
