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
        $miguelUser = User::where('email', 'miguel@desarrolloweb.com')->first();

        // 4 galerías para Miguel
        if ($miguelUser) {
            Gallery::factory(4)->create([
                'user_id' => $miguelUser->id,
            ]);
        }

        // 1 galería para cada usuario adicional
        User::where('email', '!=', 'miguel@desarrolloweb.com')->each(
            fn (User $user) => Gallery::factory(1)->create([
                'user_id' => $user->id,
            ])
        );
    }
}
