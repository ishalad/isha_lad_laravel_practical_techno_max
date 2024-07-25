<?php

namespace Database\Seeders;

use App\Models\Technology;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateUserTechnology extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $technologyIds = Technology::pluck('id')->toArray();

        // Iterate through each user
        foreach ($userIds as $userId) {
            // Pick a random number of technology IDs (between 1 and the total number of technologies)
            $randomTechnologyIds = array_rand(array_flip($technologyIds), rand(1, count($technologyIds)));

            // Ensure $randomTechnologyIds is an array
            $randomTechnologyIds = (array) $randomTechnologyIds;

            // Sync the random technology IDs with the user
            User::find($userId)->technologies()->sync($randomTechnologyIds);
        }
    }
}
