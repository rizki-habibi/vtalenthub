<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Client;
use App\Models\Talent;
use App\Models\TeamMember;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function index(): View
    {
        return view('landing', [
            'talentCount' => Talent::count(),
            'assetCount' => Asset::count(),
            'clientCount' => Client::count(),
            'teamMembers' => TeamMember::where('is_public', true)->orderBy('sort_order')->get(),
        ]);
    }
}
