<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        // DB::table('projects')->truncate();

        $type_ids = Type::all()->pluck('id')->all();

        $technology_ids = Technology::all()->pluck('id')->all();

        // $user_ids = User::all()->pluck('id')->all();

        for ($i = 0; $i < 27; $i++) {

            $new_project = new Project();
    
            $new_project->title = $faker->unique()->word();
            $new_project->slug = Str::slug($new_project->title);
            $new_project->description = $faker->text(75);
            $new_project->start_date = $faker->date();
            $new_project->end_date = $faker->date();
            $new_project->project_url = $faker->unique()->url();
            $new_project->type_id = $faker->randomElement($type_ids);

            $new_project->save();

            $random_technology_ids = $faker->randomElements($technology_ids, null);
            $new_project->technologies()->attach($random_technology_ids);

        }
    }
}
