<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Client;
use App\Models\Innovation;
use App\Models\Talent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function query(Request $request): JsonResponse
    {
        $q = trim($request->input('q', ''));

        if (mb_strlen($q) < 2) {
            return response()->json([
                'talents' => [],
                'assets' => [],
                'clients' => [],
                'innovations' => [],
            ]);
        }

        $talents = Talent::where('name', 'like', "%{$q}%")
            ->orWhere('genre', 'like', "%{$q}%")
            ->orWhere('platform', 'like', "%{$q}%")
            ->take(5)
            ->get(['id', 'name', 'platform', 'model_type', 'subscribers']);

        $assets = Asset::where('name', 'like', "%{$q}%")
            ->orWhere('type', 'like', "%{$q}%")
            ->orWhere('theme', 'like', "%{$q}%")
            ->take(5)
            ->get(['id', 'name', 'type', 'resolution', 'downloads']);

        $clients = Client::where('name', 'like', "%{$q}%")
            ->orWhere('company', 'like', "%{$q}%")
            ->orWhere('type', 'like', "%{$q}%")
            ->take(5)
            ->get(['id', 'name', 'company', 'deal_value', 'status']);

        $innovations = Innovation::where('title', 'like', "%{$q}%")
            ->orWhere('problem_statement', 'like', "%{$q}%")
            ->orWhere('proposed_solution', 'like', "%{$q}%")
            ->take(5)
            ->get(['id', 'title', 'category', 'status', 'upvotes']);

        return response()->json([
            'talents' => $talents,
            'assets' => $assets,
            'clients' => $clients,
            'innovations' => $innovations,
        ]);
    }
}
