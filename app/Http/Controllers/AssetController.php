<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Talent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssetController extends Controller
{
    public function index(Request $request): View
    {
        $query = Asset::with('talent');

        if ($type = $request->input('type')) {
            $query->where('type', $type);
        }

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        return view('dashboard.assets.index', [
            'assets' => $query->latest()->paginate(12),
            'talents' => Talent::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function create(): View
    {
        return view('dashboard.assets.create', [
            'talents' => Talent::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:background,overlay,wallpaper,emotes,logo,banner,schedule,model,rigging',
            'talent_id' => 'nullable|exists:talents,id',
            'theme' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:20',
            'resolution' => 'nullable|string|max:20',
            'notes' => 'nullable|string|max:1000',
            'price' => 'nullable|numeric|min:0',
        ]);

        $validated['created_by'] = auth()->id();
        $validated['status'] = 'generated';

        Asset::create($validated);

        return redirect()->route('assets.index')->with('success', 'Asset berhasil di-generate!');
    }

    public function show(Asset $asset): View
    {
        return view('dashboard.assets.show', compact('asset'));
    }

    public function edit(Asset $asset): View
    {
        return view('dashboard.assets.edit', [
            'asset' => $asset,
            'talents' => Talent::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(Request $request, Asset $asset): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'status' => 'required|in:draft,generated,published,sold',
            'price' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
        ]);

        $asset->update($validated);

        return redirect()->route('assets.show', $asset)->with('success', 'Asset berhasil diupdate!');
    }

    public function destroy(Asset $asset): RedirectResponse
    {
        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset berhasil dihapus.');
    }
}
