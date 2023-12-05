<?php

namespace Database\Seeders;

use App\Models\Tv;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'billy',
        ]);

        Tv::factory()->times(100)->create();
    }
}
