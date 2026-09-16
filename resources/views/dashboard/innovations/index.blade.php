@extends('layouts.dashboard')
@section('title', 'Bank Inovasi & Ide AI')
@section('page-title', 'Riset Inovasi & Celah Pasar')

@section('content')
<div class="space-y-6" x-data="innovationModule()">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold tracking-tight">Bank Inovasi & Sintesis Ide AI</h1>
            <p class="text-xs text-slate-500 mt-0.5">Riset peluang produk virtual talent yang belum ada secara global untuk dikembangkan menjadi profit.</p>
        </div>
        <div class="flex items-center gap-2">
            <button @click="generateAiIdea()" :disabled="generating"
                    class="bg-gradient-to-r from-sky-400 to-blue-500 hover:from-sky-300 hover:to-blue-400 text-slate-950 px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 shadow-lg shadow-sky-500/25">
                <i data-lucide="sparkles" class="w-4 h-4" :class="{ 'animate-spin': generating }"></i>
                <span x-text="generating ? 'AI Sedang Menganalisis Pasar...' : 'Generate Ide Baru (AI)'"></span>
            </button>
            <button @click="showModal = true" class="px-3.5 py-2 rounded-xl border border-slate-700 text-xs font-semibold hover:bg-slate-800 transition-colors flex items-center gap-1.5">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                <span>Tulis Ide</span>
            </button>
        </div>
    </div>

    <!-- Filter Kategori -->
    <div class="flex flex-wrap gap-2 text-xs">
        <a href="{{ route('innovations.index') }}" class="px-3 py-1.5 rounded-xl border {{ !request('category') ? 'bg-sky-500/15 border-sky-400/40 text-sky-400' : 'border-slate-800 text-slate-400 hover:bg-slate-800' }}">Semua</a>
        <a href="{{ route('innovations.index', ['category' => 'monetization']) }}" class="px-3 py-1.5 rounded-xl border {{ request('category') === 'monetization' ? 'bg-sky-500/15 border-sky-400/40 text-sky-400' : 'border-slate-800 text-slate-400 hover:bg-slate-800' }}">Monetisasi</a>
        <a href="{{ route('innovations.index', ['category' => 'asset_tech']) }}" class="px-3 py-1.5 rounded-xl border {{ request('category') === 'asset_tech' ? 'bg-sky-500/15 border-sky-400/40 text-sky-400' : 'border-slate-800 text-slate-400 hover:bg-slate-800' }}">Teknologi Aset</a>
        <a href="{{ route('innovations.index', ['category' => 'ai_interaction']) }}" class="px-3 py-1.5 rounded-xl border {{ request('category') === 'ai_interaction' ? 'bg-sky-500/15 border-sky-400/40 text-sky-400' : 'border-slate-800 text-slate-400 hover:bg-slate-800' }}">Interaksi AI</a>
        <a href="{{ route('innovations.index', ['category' => 'fan_experience']) }}" class="px-3 py-1.5 rounded-xl border {{ request('category') === 'fan_experience' ? 'bg-sky-500/15 border-sky-400/40 text-sky-400' : 'border-slate-800 text-slate-400 hover:bg-slate-800' }}">Pengalaman Penggemar</a>
    </div>

    <!-- Grid Kartu Inovasi -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($innovations as $inno)
        <div class="glass-auto rounded-2xl p-5 border border-slate-200/50 dark:border-slate-800 hover:border-sky-500/40 transition-all flex flex-col justify-between" data-aos="fade-up">
            <div>
                <div class="flex items-center justify-between gap-2">
                    <span class="text-[10px] uppercase font-mono px-2 py-0.5 rounded-full bg-sky-500/10 text-sky-400 border border-sky-500/20">
                        {{ str_replace('_', ' ', $inno->category) }}
                    </span>
                    @if($inno->generated_by_ai)
                    <span class="text-[10px] font-mono text-emerald-400 flex items-center gap-1">
                        <i data-lucide="bot" class="w-3 h-3"></i>
                        <span>AI GENERATED</span>
                    </span>
                    @endif
                </div>

                <h3 class="text-sm font-bold tracking-tight mt-3">{{ $inno->title }}</h3>

                <div class="mt-3 text-xs space-y-2">
                    <div>
                        <span class="text-slate-500 font-semibold text-[11px] uppercase">Celah Pasar:</span>
                        <p class="text-slate-400 text-xs mt-0.5 leading-relaxed">{{ $inno->problem_statement }}</p>
                    </div>
                    <div>
                        <span class="text-sky-400 font-semibold text-[11px] uppercase">Solusi Pengembangan:</span>
                        <p class="text-slate-300 text-xs mt-0.5 leading-relaxed">{{ $inno->proposed_solution }}</p>
                    </div>
                    @if($inno->monetization_potential)
                    <div class="p-2.5 rounded-xl bg-slate-900/80 border border-slate-800 font-mono text-[11px] text-emerald-400">
                        <span class="text-slate-500">Peluang Profit:</span> {{ $inno->monetization_potential }}
                    </div>
                    @endif
                </div>
            </div>

            <div class="pt-3 mt-4 border-t border-slate-800 flex items-center justify-between text-xs">
                <span class="text-[10px] px-2 py-0.5 rounded uppercase font-mono bg-slate-800 text-slate-400">
                    {{ $inno->status }}
                </span>
                <button @click="upvoteIdea({{ $inno->id }}, $event)" class="px-2.5 py-1 rounded-lg border border-slate-700 hover:border-sky-400 flex items-center gap-1.5 text-slate-400 hover:text-sky-400 transition-colors">
                    <i data-lucide="thumbs-up" class="w-3 h-3"></i>
                    <span class="font-mono text-[11px]" id="upvote-{{ $inno->id }}">{{ $inno->upvotes }}</span>
                </button>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16 text-slate-500 text-xs glass-auto rounded-2xl border border-slate-800">
            <i data-lucide="lightbulb" class="w-8 h-8 mx-auto text-slate-600 mb-2"></i>
            Belum ada inovasi tersimpan. Klik tombol Generate Ide (AI) untuk membuat analisis produk pertama.
        </div>
        @endforelse
    </div>

    <div>{{ $innovations->links() }}</div>

    <!-- Modal Form Tulis Ide Manual -->
    <div x-show="showModal" @click.self="showModal = false" x-transition.opacity
         class="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="w-full max-w-lg glass-auto rounded-3xl p-6 border border-slate-700 shadow-2xl space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                <h3 class="text-sm font-bold tracking-tight">Tambah Ide Inovasi Produk</h3>
                <button @click="showModal = false" class="text-slate-400 hover:text-slate-200">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <form method="POST" action="{{ route('innovations.store') }}" class="space-y-3 text-xs">
                @csrf
                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Judul Inovasi / Nama Produk *</label>
                    <input type="text" name="title" required placeholder="Contoh: Virtual Talent Multilingual AI Dubbing"
                           class="w-full bg-slate-900 rounded-xl px-3.5 py-2 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800">
                </div>

                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Kategori</label>
                    <select name="category" class="w-full bg-slate-900 rounded-xl px-3.5 py-2 text-xs outline-none border border-slate-800">
                        <option value="monetization">Monetisasi & Sponsor</option>
                        <option value="asset_tech">Teknologi Aset Siaran</option>
                        <option value="ai_interaction">Interaksi Kecerdasan Buatan (AI)</option>
                        <option value="fan_experience">Pengalaman Komunitas Fans</option>
                        <option value="event_format">Format Acara Konser Virtual</option>
                    </select>
                </div>

                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Celah Masalah yang Ada *</label>
                    <textarea name="problem_statement" rows="2" required placeholder="Jelaskan kendala apa yang belum diselesaikan agensi besar..."
                              class="w-full bg-slate-900 rounded-xl p-3 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800 resize-none"></textarea>
                </div>

                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Solusi & Pengembangan Produk *</label>
                    <textarea name="proposed_solution" rows="2" required placeholder="Jelaskan produk atau layanan baru yang akan dibuat..."
                              class="w-full bg-slate-900 rounded-xl p-3 text-xs outline-none focus:ring-1 focus:ring-sky-400 border border-slate-800 resize-none"></textarea>
                </div>

                <div>
                    <label class="block text-slate-400 mb-1 font-semibold">Estimasi Peluang Profit</label>
                    <input type="text" name="monetization_potential" placeholder="Contoh: Revenue share 15% atau langganan SaaS $29/bln"
                           class="w-full bg-slate-900 rounded-xl px-3.5 py-2 text-xs outline-none border border-slate-800">
                </div>

                <div class="flex justify-end gap-2 pt-3 border-t border-slate-800">
                    <button type="button" @click="showModal = false" class="px-4 py-2 rounded-xl text-slate-400 hover:bg-slate-800">Batal</button>
                    <button type="submit" class="bg-sky-500 hover:bg-sky-400 text-slate-950 font-semibold px-4 py-2 rounded-xl">Simpan Inovasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function innovationModule() {
    return {
        showModal: false,
        generating: false,
        async generateAiIdea() {
            this.generating = true;
            try {
                const res = await fetch('{{ route("innovations.generate-ai") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ theme: 'all' })
                });
                const data = await res.json();
                if (data.success) {
                    location.reload();
                }
            } catch (err) {
                alert('Gagal mensintesis ide melalui AI.');
            } finally {
                this.generating = false;
            }
        },
        async upvoteIdea(id, evt) {
            try {
                const res = await fetch(`/innovations/${id}/upvote`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                const data = await res.json();
                if (data.success) {
                    document.getElementById(`upvote-${id}`).innerText = data.upvotes;
                }
            } catch (e) {
                console.error(e);
            }
        }
    }
}
</script>
@endpush
@endsection
