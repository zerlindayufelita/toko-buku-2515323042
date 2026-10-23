<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        \App\Models\Publisher::create([
            'name' => 'Gramedia Pustaka Utama',
            'city' => 'Jakarta',
        ]);

        \App\Models\Publisher::create([
            'name' => 'Erlangga',
            'city' => 'Jakarta',
        ]);

        \App\Models\Publisher::create([
            'name' => 'Mizan',
            'city' => 'Bandung',
        ]);
    }
}
