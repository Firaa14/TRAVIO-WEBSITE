<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada user terlebih dahulu
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->error('No users found. Please run UserSeeder first.');
            return;
        }

        $locations = [
            'Pantai Balekambang',
            'Gunung Bromo',
            'Coban Rondo',
            'Kebun Teh Lawang',
            'Pantai Malang Selatan',
            'Taman Safari',
            'Candi Borobudur',
            'Kawah Ijen',
            'Pulau Sempu',
            'Air Terjun Tumpak Sewu'
        ];

        $captions = [
            'Pemandangan yang sangat indah! Sangat recommended untuk liburan keluarga.',
            'Sunrise terbaik yang pernah saya lihat. Worth it banget perjalanannya!',
            'Tempat yang sempurna untuk healing dan menikmati alam.',
            'Pengalaman yang tak terlupakan bersama keluarga. Suasananya sangat asri.',
            'Spot foto keren dan instagramable! Pasti balik lagi kesini.',
            'Perjalanan yang menantang tapi hasil fotonya memuaskan.',
            'Tempat wisata yang wajib dikunjungi kalau ke Jawa Timur!',
            'Suasana yang tenang dan damai, cocok untuk refreshing.',
            'Pelayanan ramah, tempat bersih, dan pemandangan menakjubkan.',
            'Liburan terbaik tahun ini! Sudah planning mau kesini lagi.',
            'Tempatnya sangat bagus untuk fotografi landscape.',
            'Wisata edukatif yang cocok untuk anak-anak.',
            'Budget friendly dan worth it untuk dikunjungi.',
            'Akses mudah dan fasilitas lengkap. Recommended!',
            'Pemandangan 360 derajat yang spektakuler!'
        ];

        $images = [
            'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800',
            'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800',
            'https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=800',
            'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800',
            'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800',
            'https://images.unsplash.com/photo-1472214103451-9374bd1c798e?w=800',
            'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800',
            'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=800',
            'https://images.unsplash.com/photo-1426604966848-d7adac402bff?w=800',
            'https://images.unsplash.com/photo-1511497584788-876760111969?w=800',
            'https://images.unsplash.com/photo-1470770841072-f978cf4d019e?w=800',
            'https://images.unsplash.com/photo-1447752875215-b2761acb3c5d?w=800',
            'https://images.unsplash.com/photo-1465056836041-7f43ac27dcb5?w=800',
            'https://images.unsplash.com/photo-1483728642387-6c3bdd6c93e5?w=800',
            'https://images.unsplash.com/photo-1475924156734-496f6cac6ec1?w=800',
        ];

        // Create 20 gallery posts
        for ($i = 0; $i < 20; $i++) {
            Gallery::create([
                'user_id' => $users->random()->id,
                'location' => $locations[array_rand($locations)],
                'caption' => $captions[array_rand($captions)],
                'image' => $images[array_rand($images)],
            ]);
        }

        $this->command->info('Gallery seeder completed successfully!');
    }
}
