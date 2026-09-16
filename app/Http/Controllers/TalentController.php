<?php

namespace App\Http\Controllers;

use App\Models\Talent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TalentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Talent::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($platform = $request->input('platform')) {
            $query->where('platform', $platform);
        }

        $sort = $request->input('sort', 'newest');
        $query = match ($sort) {
            'name' => $query->orderBy('name'),
            'subscribers' => $query->orderByDesc('subscribers'),
            default => $query->latest(),
        };

        return view('dashboard.talents.index', [
            'talents' => $query->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('dashboard.talents.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'real_name' => 'nullable|string|max:255',
            'platform' => 'required|in:youtube,twitch,tiktok,bilibili,multi',
            'status' => 'required|in:active,onboarding,inactive',
            'subscribers' => 'nullable|integer|min:0',
            'model_type' => 'required|in:live2d,3d,png,none',
            'genre' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:50',
            'bio' => 'nullable|string|max:2000',
            'youtube_url' => 'nullable|url|max:500',
            'twitch_url' => 'nullable|url|max:500',
            'tiktok_url' => 'nullable|url|max:500',
            'twitter_url' => 'nullable|url|max:500',
            'needs' => 'nullable|array',
        ]);

        $needs = $validated['needs'] ?? [];
        unset($validated['needs']);

        $talent = Talent::create($validated);

        foreach ($needs as $need) {
            $talent->needs()->create(['need_type' => $need]);
        }

        return redirect()->route('talents.index')->with('success', 'Talent berhasil ditambahkan!');
    }

    public function show(Talent $talent): View
    {
        $talent->load(['needs', 'assets', 'clients']);

        return view('dashboard.talents.show', compact('talent'));
    }

    public function edit(Talent $talent): View
    {
        return view('dashboard.talents.edit', compact('talent'));
    }

    public function update(Request $request, Talent $talent): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'real_name' => 'nullable|string|max:255',
            'platform' => 'required|in:youtube,twitch,tiktok,bilibili,multi',
            'status' => 'required|in:active,onboarding,inactive',
            'subscribers' => 'nullable|integer|min:0',
            'model_type' => 'required|in:live2d,3d,png,none',
            'genre' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:50',
            'bio' => 'nullable|string|max:2000',
        ]);

        $talent->update($validated);

        return redirect()->route('talents.show', $talent)->with('success', 'Talent berhasil diupdate!');
    }

    public function destroy(Talent $talent): RedirectResponse
    {
        $talent->delete();

        return redirect()->route('talents.index')->with('success', 'Talent berhasil dihapus.');
    }
}
