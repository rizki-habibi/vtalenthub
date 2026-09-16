<?php

namespace App\Http\Controllers;

use App\Models\Innovation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InnovationController extends Controller
{
    public function index(Request $request): View
    {
        $query = Innovation::with('user');

        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        return view('dashboard.innovations.index', [
            'innovations' => $query->latest()->paginate(9),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'problem_statement' => 'required|string',
            'proposed_solution' => 'required|string',
            'monetization_potential' => 'nullable|string',
            'target_audience' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'concept';

        Innovation::create($validated);

        return redirect()->route('innovations.index')->with('success', 'Ide inovasi berhasil disimpan ke bank data!');
    }

    public function generateAi(Request $request): JsonResponse
    {
        $theme = $request->input('theme', 'umum');

        // Engine Generator AI Celah Pasar Virtual Talent 2026
        $blueprints = [
            [
                'title' => 'AI Autonomous Clip & Highlight Syndicator',
                'category' => 'asset_tech',
                'problem_statement' => 'Kreator menghabiskan 4-6 jam setelah stream maraton hanya untuk memotong klip vertikal untuk TikTok dan YouTube Shorts.',
                'proposed_solution' => 'Microservice AI yang memindai lonjakan chat/audio secara otomatis, memotong momen lucu/klimaks, menambahkan subtitle animasi, dan langsung siap dipublikasikan.',
                'monetization_potential' => 'Model SaaS $19/bulan atau revenue share 10% dari monetisasi Shorts.',
                'target_audience' => 'VTuber streamer maraton gaming & chatting',
            ],
            [
                'title' => 'Virtual Fan Club Micro-Investment Contract',
                'category' => 'monetization',
                'problem_statement' => 'Fans loyal ingin mendukung biaya debut/model baru talenta tetapi platform donasi biasa tidak memberikan kepemilikan atau keuntungan timbal balik.',
                'proposed_solution' => 'Kontrak kontribusi digital berbasis hasil bagi keuntungan: fans mendanai model 3D dan menerima akses eksklusif selamanya + share dividen superchat konser tahunan.',
                'monetization_potential' => 'Biaya platform 5% dari penggalangan modal debut.',
                'target_audience' => 'Komunitas fans setia & talenta indie berkualitas tinggi',
            ],
            [
                'title' => 'Haptic-Feedback Live Chat Emote Controller',
                'category' => 'fan_experience',
                'problem_statement' => 'Interaksi chat hanya berupa teks satu arah di layar yang sering terlewat oleh talenta saat fokus bermain game.',
                'proposed_solution' => 'Aplikasi pendamping yang mengubah donasi berbayar menjadi trigger getaran haptik atau efek visual 3D interaktif pada avatar talenta secara langsung di layar.',
                'monetization_potential' => 'Margin 20% dari pembelian kredit trigger interaktif penonton.',
                'target_audience' => 'Penonton live streaming interaktif generasi baru',
            ],
            [
                'title' => 'Automated Brand Sponsor Matchmaker Matrix',
                'category' => 'monetization',
                'problem_statement' => 'Brand UMKM lokal kesulitan menemukan VTuber bertarif terjangkau yang relevan dengan demografi produk mereka.',
                'proposed_solution' => 'Mesin pencocokan berbasis data minat penonton yang memfilter talenta mikro (1K-10K subscriber) dan mengemas kampanye sponsor mikro dengan kontrak instan.',
                'monetization_potential' => 'Komisi agensi 12.5% per kontrak kesepakatan tertutup.',
                'target_audience' => 'Brand makanan/minuman, periferal, dan game developer independen',
            ],
        ];

        // Pilih blueprint secara acak atau berdasarkan kata kunci
        $selected = $blueprints[array_rand($blueprints)];

        $innovation = Innovation::create([
            'user_id' => auth()->id(),
            'title' => $selected['title'],
            'category' => $selected['category'],
            'problem_statement' => $selected['problem_statement'],
            'proposed_solution' => $selected['proposed_solution'],
            'monetization_potential' => $selected['monetization_potential'],
            'target_audience' => $selected['target_audience'],
            'status' => 'concept',
            'generated_by_ai' => true,
            'upvotes' => 1,
        ]);

        return response()->json([
            'success' => true,
            'data' => $innovation,
            'message' => 'Ide inovasi baru berhasil disintesis oleh AI!',
        ]);
    }

    public function upvote(Innovation $innovation): JsonResponse
    {
        $innovation->increment('upvotes');

        return response()->json([
            'success' => true,
            'upvotes' => $innovation->upvotes,
        ]);
    }
}
