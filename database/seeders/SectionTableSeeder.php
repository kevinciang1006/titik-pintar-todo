<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Section::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few Section in our database:
        for ($i = 0; $i < 10; $i++) {
            Section::create([
                'name' => $faker->name,
            ]);
        }
    }
}
