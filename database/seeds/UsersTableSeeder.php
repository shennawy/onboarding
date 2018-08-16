<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Truncate table first
        User::truncate();

        $faker =\Faker\Factory::create();
        static $password;
        //Add a few users
        for ($i=0; $i<50; $i++){
            User::create([
                'name'=>$faker->name,
                'email'=>$faker->unique()->safeEmail,
                'password'=>$password ?: $password = bcrypt('secret'),
            ]);

        }

    }
}
