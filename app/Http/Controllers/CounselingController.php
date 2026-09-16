<?php

namespace App\Http\Controllers;

use App\Models\CounselingSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CounselingController extends Controller
{
    public function index(): View
    {
        $sessions = CounselingSession::where('user_id', auth()->id())
            ->latest()
            ->paginate(20);

        return view('dashboard.counseling.index', compact('sessions'));
    }

    public function ask(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'question' => 'required|string|max:2000',
            'topic' => 'nullable|string|max:100',
        ]);

        // ponytail: AI integration — for now returns pre-built responses. Upgrade to OpenAI/Claude API when ready.
        $answer = $this->generateAnswer($validated['question']);

        $session = CounselingSession::create([
            'user_id' => auth()->id(),
            'topic' => $validated['topic'] ?? 'general',
            'question' => $validated['question'],
            'answer' => $answer,
            'status' => 'answered',
        ]);

        return response()->json([
            'answer' => $answer,
            'session_id' => $session->id,
        ]);
    }

    private function generateAnswer(string $question): string
    {
        $question = mb_strtolower($question);

        $responses = [
            'mulai' => "🎭 **Cara Mulai Jadi VTuber dari Nol:**\n\n1. **Tentukan Konsep** — Buat persona/karakter unik (nama, lore, kepribadian)\n2. **Pilih Model** — PNG Tuber (gratis), VRoid (gratis), Live2D ($200-$3000), 3D ($500-$5000)\n3. **Setup Software** — OBS Studio + VTube Studio/VSeeFace\n4. **Siapkan Hardware** — Webcam/iPhone untuk face tracking + microphone\n5. **Buat Channel** — YouTube/Twitch, desain banner & overlay\n6. **Debut!** — Buat teaser, umumkan di social media, dan mulai streaming\n\n💡 Tips: Mulai dari PNG Tuber atau VRoid Studio kalau budget terbatas. Yang penting konsisten streaming!",

            'biaya' => "💰 **Estimasi Biaya Jadi VTuber:**\n\n| Item | Gratis | Budget | Premium |\n|------|--------|--------|----------|\n| Model 2D | VRoid | $200-500 | $800-3000+ |\n| Model 3D | VRoid | $500-1000 | $2000-5000+ |\n| Rigging | — | $100-300 | $500-1500 |\n| Overlay | Template | $20-100 | $200-500 |\n| Emotes | DIY | $30-80 | $150-400 |\n| Logo+Banner | Canva | $20-80 | $100-300 |\n| Mic | Headset | $30-100 | $200-500 |\n\n🎯 **Total Minimum:** $0 (semua gratis)\n🎯 **Budget Rekomendasi:** $300-$800\n🎯 **Premium Setup:** $2000-$5000+",

            'software' => "🛠️ **Software yang Dibutuhkan VTuber:**\n\n**Streaming:**\n- OBS Studio (Gratis) — Software streaming utama\n- Streamlabs (Gratis) — Alternatif OBS lebih simpel\n\n**Face Tracking:**\n- VTube Studio (Gratis/Pro) — Terbaik untuk Live2D\n- VSeeFace (Gratis) — Bagus untuk 3D\n- Animaze (Freemium) — By FaceRig\n\n**Model Creation:**\n- VRoid Studio (Gratis) — Buat model 3D mudah\n- Live2D Cubism (Free/Pro) — Untuk model 2D\n- Blender (Gratis) — Untuk model 3D custom\n\n**Design:**\n- Canva (Gratis) — Banner, thumbnail\n- Figma (Gratis) — Overlay design\n- GIMP/Krita (Gratis) — Alternatif Photoshop",

            'monetisasi' => "📈 **Cara Monetisasi sebagai VTuber:**\n\n1. **Super Chat/Donasi** — Langsung dari penonton saat live\n2. **Membership/Subscribe** — Konten eksklusif berbayar\n3. **Sponsorship** — Brand deals ($100-$10,000+ per deal)\n4. **Merchandise** — Jual acrylic stand, dakimakura, stiker\n5. **Commission** — Terima pesanan voice pack, ASMR\n6. **Affiliate** — Promosikan produk gaming/tech\n7. **Music** — Release original song di Spotify/Apple Music\n8. **Events** — Live concert, fan meeting\n\n💡 Target: Mulai monetisasi setelah 1000 subscriber di YouTube (syarat YPP)",

            'tracking' => "📱 **Setup Face Tracking:**\n\n**Terbaik (Budget):** iPhone + VTube Studio\n- iPhone punya TrueDepth camera (Face ID)\n- Tracking sangat smooth dan akurat\n- Bisa wireless via WiFi\n\n**Alternatif (Gratis):** Webcam + VSeeFace\n- Webcam biasa sudah cukup\n- Kualitas tracking cukup bagus\n- Gratis 100%\n\n**Premium:** Mocap suit\n- Full body tracking\n- Untuk performance/concert\n- Harga $500-$5000+",
        ];

        foreach ($responses as $keyword => $response) {
            if (str_contains($question, $keyword)) {
                return $response;
            }
        }

        return "🤖 Terima kasih atas pertanyaannya!\n\nUntuk saat ini saya bisa membantu seputar:\n- 🎭 Cara mulai jadi VTuber\n- 💰 Estimasi biaya\n- 🛠️ Software yang dibutuhkan\n- 📈 Strategi monetisasi\n- 📱 Setup face tracking\n\nCoba tanyakan salah satu topik di atas, atau hubungi team VTalentHub untuk konsultasi lebih lanjut!";
    }
}
