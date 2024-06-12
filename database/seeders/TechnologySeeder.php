<?php

namespace Database\Seeders;

use App\Models\Technology;
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

        $technologies = ['css','js','vue','sql','php','laravel'];

        foreach ($technologies as $tecnology) {
            $new_tecnology = new Technology();

            $new_tecnology->title = $tecnology;

            $new_tecnology->save();
        }

    }
}
