@extends('layouts.dashboard')
@section('title', 'Konseling & Kurikulum Virtual Talent')
@section('page-title', 'Konseling & Onboarding')

@section('content')
<div class="space-y-6" x-data="counselingApp()">
    <div>
        <h1 class="text-xl font-bold tracking-tight">Kurikulum & Asisten Konsultasi VTuber</h1>
        <p class="text-xs text-slate-500 mt-0.5">Panduan bertahap teknis, penentuan identitas virtual, dan penanganan pertanyaan seputar ekosistem.</p>
    </div>

    <div class="grid lg:grid-cols-12 gap-6">
        <!-- Checklist Kurikulum (7 Kolom) -->
        <div class="lg:col-span-7 space-y-4">
            <div class="glass-auto rounded-2xl p-5 border border-slate-200/50 dark:border-slate-800">
                <div class="flex items-center gap-2 mb-4">
                    <i data-lucide="check-square" class="w-4 h-4 text-sky-400"></i>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-300">Tahap Onboarding Menuju Debut Siaran</h3>
                </div>

                <div class="space-y-3 text-xs">
                    <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-800">
                        <div class="font-bold text-sky-400">Tahap 1: Konsep Identitas & Lore Karakter</div>
                        <p class="text-slate-500 text-[11px] mt-0.5">Penetapan nama panggung, latar belakang cerita, visual palet warna, dan gaya bahasa interaksi.</p>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-800">
                        <div class="font-bold text-sky-400">Tahap 2: Pembuatan Model & Pengikatan Rigging</div>
                        <p class="text-slate-500 text-[11px] mt-0.5">Pemilihan format (VRoid 3D / Live2D Cubism), pemotongan lapisan PSD, dan kalibrasi parameter gerakan.</p>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-800">
                        <div class="font-bold text-sky-400">Tahap 3: Integrasi Perangkat Lunak Pelacak</div>
                        <p class="text-slate-500 text-[11px] mt-0.5">Konfigurasi VTube Studio dengan kamera iOS TrueDepth atau webcam PC via VSeeFace/OpenSeeFace.</p>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-800">
                        <div class="font-bold text-sky-400">Tahap 4: Penyiapan Scene OBS & Audio</div>
                        <p class="text-slate-500 text-[11px] mt-0.5">Pemasangan virtual camera spout2, filter noise gate mikrofon, isolasi audio game, dan stream overlay.</p>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-800">
                        <div class="font-bold text-sky-400">Tahap 5: Pelaksanaan Siaran Debut Perdana</div>
                        <p class="text-slate-500 text-[11px] mt-0.5">Penerbitan visual teaser media sosial, presentasi slide perkenalan, dan interaksi chat awal pemirsa.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dialog Asisten Virtual (5 Kolom) -->
        <div class="lg:col-span-5 flex flex-col glass-auto rounded-2xl border border-slate-200/50 dark:border-slate-800 h-[560px]">
            <div class="p-4 border-b border-slate-800 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-300">Asisten Konsultasi Virtual</span>
                </div>
                <span class="text-[10px] font-mono text-slate-500">v1.2-engine</span>
            </div>

            <!-- Pesan Chat -->
            <div class="flex-1 p-4 overflow-y-auto space-y-3 text-xs" id="chatArea">
                <template x-for="msg in messages" :key="msg.id">
                    <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                        <div :class="msg.role === 'user' ? 'bg-sky-500 text-slate-950 font-medium' : 'bg-slate-900/90 border border-slate-800 text-slate-200'"
                             class="max-w-[85%] rounded-2xl p-3 text-xs leading-relaxed whitespace-pre-line"
                             x-text="msg.text">
                        </div>
                    </div>
                </template>
                <div x-show="loading" class="flex justify-start">
                    <div class="bg-slate-900/90 border border-slate-800 text-slate-400 rounded-2xl p-3 text-xs flex items-center gap-2">
                        <i data-lucide="loader-2" class="w-3.5 h-3.5 animate-spin"></i>
                        <span>Memproses pertanyaan...</span>
                    </div>
                </div>
            </div>

            <!-- Tombol Cepat -->
            <div class="p-2 border-t border-slate-800/60 bg-slate-950/40 flex gap-1.5 overflow-x-auto text-[11px]">
                <button @click="quickAsk('Bagaimana cara mulai jadi VTuber dari nol?')" class="px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 shrink-0">Alur Awal</button>
                <button @click="quickAsk('Berapa estimasi rincian biaya kebutuhan VTuber?')" class="px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 shrink-0">Estimasi Biaya</button>
                <button @click="quickAsk('Perangkat lunak apa saja yang wajib dipasang?')" class="px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 shrink-0">Software</button>
                <button @click="quickAsk('Bagaimana metode monetisasi siaran virtual?')" class="px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 shrink-0">Monetisasi</button>
            </div>

            <!-- Input Form -->
            <form @submit.prevent="sendMessage()" class="p-3 border-t border-slate-800 flex gap-2">
                <input type="text" x-model="inputQuestion" placeholder="Tuliskan pertanyaan seputar VTuber..."
                       class="flex-1 bg-slate-900/80 rounded-xl px-3 py-2 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800">
                <button type="submit" :disabled="loading || !inputQuestion.trim()"
                        class="bg-sky-500 hover:bg-sky-400 disabled:opacity-50 text-slate-950 px-3.5 py-2 rounded-xl text-xs font-bold transition-all">
                    <i data-lucide="send" class="w-3.5 h-3.5"></i>
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function counselingApp() {
    return {
        messages: [
            { id: 1, role: 'assistant', text: 'Sistem operasional agensi siap. Ajukan pertanyaan seputar tahapan teknis, kebutuhan perlengkapan, atau panduan monetisasi siaran virtual.' }
        ],
        inputQuestion: '',
        loading: false,
        quickAsk(text) {
            this.inputQuestion = text;
            this.sendMessage();
        },
        async sendMessage() {
            if (!this.inputQuestion.trim() || this.loading) return;
            const q = this.inputQuestion;
            this.messages.push({ id: Date.now(), role: 'user', text: q });
            this.inputQuestion = '';
            this.loading = true;
            this.$nextTick(() => {
                const el = document.getElementById('chatArea');
                el.scrollTop = el.scrollHeight;
            });

            try {
                const res = await fetch('{{ route("counseling.ask") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ question: q })
                });
                const data = await res.json();
                this.messages.push({ id: Date.now() + 1, role: 'assistant', text: data.answer });
            } catch (err) {
                this.messages.push({ id: Date.now() + 1, role: 'assistant', text: 'Gagal terhubung dengan basis pengetahuan konsultasi.' });
            } finally {
                this.loading = false;
                this.$nextTick(() => {
                    const el = document.getElementById('chatArea');
                    el.scrollTop = el.scrollHeight;
                    lucide.createIcons();
                });
            }
        }
    }
}
</script>
@endpush
@endsection
