<?php

namespace Database\Seeders;

use App\Models\Answers;
use Illuminate\Database\Seeder;

class AnswersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Answers::factory(1000)->create();
    }
}
