<?php

use Illuminate\Database\Seeder;
use App\BankAccount;

class bankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        BankAccount::truncate();
        $faker= \Faker\Factory::create();
        for($i=0; $i<50; $i++){
            for($j=0; $j<5; $j++){
                bankAccount::create([
                    'user_id'=>$faker->numberBetween($min = 1, $max = 49),
                    'CurrencyId'=>$faker->randomDigit,
                    'BankName'=>$faker->company,
                    'HolderName'=>$faker->name,
                    'AccountNumber'=>$faker->bankAccountNumber,
                    'BankLocation'=>$faker->address,
                    'SwiftCode'=>$faker->randomDigit

                    ]);
            }
            
        }
    }
}
