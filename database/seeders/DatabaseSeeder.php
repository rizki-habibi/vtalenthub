<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Client;
use App\Models\Talent;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@vtalenthub.internal'],
            [
                'name' => 'Agency Director',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Talent Seed
        $t1 = Talent::create([
            'user_id' => $admin->id,
            'name' => 'Aoi Takahashi',
            'real_name' => 'Talent Alpha',
            'platform' => 'youtube',
            'status' => 'active',
            'subscribers' => 38200,
            'model_type' => 'live2d',
            'genre' => 'Cyber Gaming & Speedruns',
            'language' => 'ID/EN',
            'bio' => 'Karakter gadis hacker futuristik dari distrik Neo-Jakarta.',
            'monthly_revenue' => 14500000,
        ]);

        $t2 = Talent::create([
            'user_id' => $admin->id,
            'name' => 'Rina Melodia',
            'real_name' => 'Talent Beta',
            'platform' => 'twitch',
            'status' => 'active',
            'subscribers' => 19400,
            'model_type' => '3d',
            'genre' => 'ASMR Acoustic & Song Cover',
            'language' => 'ID',
            'bio' => 'Virtual idol berkonsep peri hutan penyembuh suara lelah.',
            'monthly_revenue' => 8750000,
        ]);

        $t3 = Talent::create([
            'user_id' => $admin->id,
            'name' => 'Kurogane Jin',
            'real_name' => 'Talent Gamma',
            'platform' => 'youtube',
            'status' => 'onboarding',
            'subscribers' => 3100,
            'model_type' => 'live2d',
            'genre' => 'Tactical FPS & Tech Talk',
            'language' => 'ID',
            'bio' => 'Ksatria cyber yang mengulas hardware dan strategi competitive gaming.',
            'monthly_revenue' => 1200000,
        ]);

        // Needs
        $t1->needs()->createMany([
            ['need_type' => 'background', 'status' => 'completed'],
            ['need_type' => 'overlay', 'status' => 'completed'],
            ['need_type' => 'emotes', 'status' => 'in_progress'],
        ]);

        $t2->needs()->createMany([
            ['need_type' => 'model', 'status' => 'completed'],
            ['need_type' => 'bgm', 'status' => 'completed'],
        ]);

        $t3->needs()->createMany([
            ['need_type' => 'rigging', 'status' => 'in_progress'],
            ['need_type' => 'schedule', 'status' => 'needed'],
        ]);

        // Assets Seed
        Asset::create([
            'talent_id' => $t1->id,
            'created_by' => $admin->id,
            'name' => 'Neo Jakarta Penthouse Backdrop',
            'type' => 'background',
            'theme' => 'Cyberpunk Cyan',
            'resolution' => '1920x1080',
            'status' => 'published',
            'downloads' => 142,
        ]);

        Asset::create([
            'talent_id' => $t1->id,
            'created_by' => $admin->id,
            'name' => 'HUD Stream Frame V2',
            'type' => 'overlay',
            'theme' => 'Minimalist Slate',
            'resolution' => '1920x1080',
            'status' => 'published',
            'downloads' => 88,
        ]);

        Asset::create([
            'talent_id' => $t2->id,
            'created_by' => $admin->id,
            'name' => 'Enchanted Forest Live Wallpaper',
            'type' => 'wallpaper',
            'theme' => 'Pastel Emerald',
            'resolution' => '2560x1440',
            'status' => 'published',
            'downloads' => 64,
        ]);

        // Clients Seed
        Client::create([
            'user_id' => $admin->id,
            'talent_id' => $t1->id,
            'name' => 'Asus ROG Indonesia',
            'company' => 'PT Asus Technology',
            'contact_person' => 'Budi Santoso',
            'email' => 'partnerships@rog.co.id',
            'status' => 'completed',
            'type' => 'sponsorship',
            'deal_value' => 25000000,
            'notes' => 'Penayangan banner monitor dan 3x live unboxing headset.',
        ]);

        Client::create([
            'user_id' => $admin->id,
            'talent_id' => $t2->id,
            'name' => 'Secretlab SEA',
            'company' => 'Secretlab SG Pte Ltd',
            'contact_person' => 'Clarissa Chen',
            'email' => 'collab@secretlab.sg',
            'status' => 'active',
            'type' => 'sponsorship',
            'deal_value' => 18000000,
            'notes' => 'Sponsorship kursi gaming edisi spesial anime.',
        ]);

        Client::create([
            'user_id' => $admin->id,
            'name' => 'Indie Game Festival 2026',
            'company' => 'Asosiasi Game Indonesia',
            'status' => 'negotiation',
            'type' => 'talent-hire',
            'deal_value' => 12000000,
            'notes' => 'Host live streaming showcase demo game lokal.',
        ]);
    }
}
