<?php

    namespace Database\Seeders;

    use Database\Factories\QuestionFactory;
    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run()
        {

            $this->call(UserSeeder::class);
            $this->call(QuizSeeder::class);
            $this->call(QuestionSeeder::class);
         //   $this->call(AnswersSeeder::class);
         //   $this->call(ResultSeeder::class);
        }
    }
