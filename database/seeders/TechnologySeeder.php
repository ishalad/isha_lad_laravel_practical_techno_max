<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['PHP', 'MySQL', 'Laravel', 'CodeIgniter', 'VueJs'];

    foreach ($technologies as $tech) {
        DB::table('technologies')->insert([
            'name' => $tech,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    }
}
