<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Asset;
use App\Models\Client;
use App\Models\Talent;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard.index', [
            'talentCount' => Talent::count(),
            'assetCount' => Asset::count(),
            'clientCount' => Client::where('status', 'active')->count(),
            'totalRevenue' => Client::where('status', 'completed')->sum('deal_value'),
            'recentTalents' => Talent::latest()->take(5)->get(),
            'recentActivity' => ActivityLog::with('user')->latest()->take(10)->get(),
            'monthlyRevenue' => Client::where('status', 'completed')
                ->selectRaw("strftime('%Y-%m', created_at) as month, SUM(deal_value) as total")
                ->groupBy('month')
                ->orderBy('month')
                ->take(12)
                ->get(),
        ]);
    }
}
