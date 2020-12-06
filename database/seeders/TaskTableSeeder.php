<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Task::truncate();

        $faker = \Faker\Factory::create();

        $states = ['to do', 'done'];

        // And now, let's create a few Task in our database:
        for ($i = 0; $i < 10; $i++) {
            $task = $faker->numberBetween($min = 3, $max = 10);
            for ($j=0; $j < $task; $j++) { 
                $stateIndex = $faker->numberBetween(0, 1);
                Task::create([
                    'section_id' => $i + 1,
                    'name' => $faker->name,
                    'state' => $states[$stateIndex]
                ]);
            }
        }
    }
}
