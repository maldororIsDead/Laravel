<?php

use Illuminate\Database\Seeder;

//require_once '/path/to/Faker/src/autoload.php';

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $companies = [];
        for ($i = 0; $i < 3; $i++) {
            $companies[] = [
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'patronymic' => $faker->lastName,
                'email' =>  $faker->companyEmail,
                'password' => md5('123456'),
                'role' => 'company'
            ];
        }
        DB::table('users')->insert($companies);
        $workers = [];
        for ($i = 0; $i < 3; $i++) {
            $workers[] = [
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'patronymic' => $faker->lastName,
                'email' => $faker->email,
                'password' => md5('123456'),
                'role' => 'worker'
            ];
        }
        DB::table('users')->insert($workers);
    }
}
