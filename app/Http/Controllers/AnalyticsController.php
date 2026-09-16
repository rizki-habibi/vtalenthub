<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Client;
use App\Models\Talent;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class AnalyticsController extends Controller
{
    public function index(): View
    {
        return view('dashboard.analytics.index');
    }

    public function data(): JsonResponse
    {
        return response()->json([
            'platforms' => Talent::selectRaw('platform, COUNT(*) as count')
                ->groupBy('platform')->get(),
            'statuses' => Talent::selectRaw('status, COUNT(*) as count')
                ->groupBy('status')->get(),
            'assetCategories' => Asset::selectRaw('type, COUNT(*) as count')
                ->groupBy('type')->get(),
            'revenueByType' => Client::where('status', 'completed')
                ->selectRaw('type, SUM(deal_value) as total')
                ->groupBy('type')->get(),
            'monthlyRevenue' => Client::where('status', 'completed')
                ->selectRaw("strftime('%Y-%m', created_at) as month, SUM(deal_value) as total")
                ->groupBy('month')->orderBy('month')->take(12)->get(),
            'totals' => [
                'talents' => Talent::count(),
                'assets' => Asset::count(),
                'clients' => Client::count(),
                'revenue' => Client::where('status', 'completed')->sum('deal_value'),
            ],
        ]);
    }

    public function export(string $type): JsonResponse
    {
        $data = match ($type) {
            'talents' => Talent::all(),
            'assets' => Asset::all(),
            'clients' => Client::all(),
            'all' => [
                'talents' => Talent::all(),
                'assets' => Asset::all(),
                'clients' => Client::all(),
            ],
            default => [],
        };

        return response()->json($data);
    }
}
