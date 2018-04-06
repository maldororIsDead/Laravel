<?php

use Illuminate\Database\Seeder;

class ResumesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'patronymic' => $faker->lastName,
                'post' => $faker->jobTitle,
                'email' => $faker->email,
                'category_id' => mt_rand(1, 12),
                'age' => $faker->biasedNumberBetween($min = 18, $max = 40),
                'city' => $faker->city,
                'education' => str_random(10),
                'phone' => $faker->randomNumber,
                'salary' => $faker->numberBetween($min = 5000, $max = 45000),
                'employment_type' => 'полная занятость',
                'description' => $faker->text($maxNbChars = 200),
                'user_id' => mt_rand(4, 6)
            ];
        }
        DB::table('resumes')->insert($data);
    }
}
