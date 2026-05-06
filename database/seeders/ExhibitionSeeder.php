<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exhibition;
use App\Models\Booth;
use App\Models\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ExhibitionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create a Creator User if not exists
        $creator = User::firstOrCreate(
            ['email' => 'creator@demo.com'],
            [
                'name' => 'John Creator',
                'password' => Hash::make('password123'),
                'role' => 'creator'
            ]
        );

        // 2. Create an Exhibition
        $exhibition = Exhibition::create([
            'title' => 'Global Tech Expo 2026',
            'description' => 'A futuristic showcase of the latest in virtual reality and AI technology.',
            'creator_id' => $creator->_id,
            'views' => 1250
        ]);

        // 3. Add 4 Sample Booths
        $boothData = [
            ['title' => 'AI Innovation Lab', 'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995'],
            ['title' => 'VR Gaming Zone', 'image' => 'https://images.unsplash.com/photo-1622979135225-d2ba269cf1ac'],
            ['title' => 'Quantum Computing', 'image' => 'https://images.unsplash.com/photo-1635070041078-e363dbe005cb'],
            ['title' => 'Robotics Future', 'image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e'],
        ];

        foreach ($boothData as $data) {
            Booth::create([
                'title' => $data['title'],
                'description' => 'Welcome to the ' . $data['title'] . '. Explore our cutting-edge solutions.',
                'image_url' => $data['image'] . '?auto=format&fit=crop&q=80&w=800',
                'exhibition_id' => $exhibition->_id
            ]);
        }

        // 4. Add 4 Sample Sessions
        $sessionData = [
            ['title' => 'The Future of Web 3.0', 'time' => '10:00 AM'],
            ['title' => 'AI Ethics Keynote', 'time' => '12:30 PM'],
            ['title' => 'VR in Education', 'time' => '03:00 PM'],
            ['title' => 'Metaverse Networking', 'time' => '05:45 PM'],
        ];

        foreach ($sessionData as $data) {
            Session::create([
                'title' => $data['title'],
                'time' => $data['time'],
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Sample Video
                'exhibition_id' => $exhibition->_id
            ]);
        }
    }
}
