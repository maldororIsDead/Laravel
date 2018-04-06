<?php

use Illuminate\Database\Seeder;

class VacanciesTableSeeder extends Seeder
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
                'title' =>  $faker->jobTitle,
                'company' => $faker->company,
                'contact_name' => $faker->name,
                'phone' => $faker->randomNumber,
                'salary' => $faker->numberBetween($min = 5000, $max = 45000),
                'category_id' => mt_rand(1, 12),
                'city' => $faker->city,
                'employment_type' => 'полная занятость',
                'requirements' => $faker->text($maxNbChars = 50),
                'description' => $faker->text($maxNbChars = 500),
                'user_id' => mt_rand(1, 3)
            ];
        }
        DB::table('vacancies')->insert($data);
    }
}
