<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario especial con credenciales predefinidas
        User::factory()->create([
            'name' => 'Miguel Angel Alvarez',
            'email' => 'miguel@desarrolloweb.com',
            'password' => 'password',
        ]);

        // Usuarios adicionales
        User::factory(3)->create();
    }
}
