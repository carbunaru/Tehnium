<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Cosmin Carbunaru',
            'email'=>'carbunaru_cosmin@yahoo.com',
            'password'=>bcrypt('Parola1!'),
            'address'=>'Romania, Ilfov, Popesti-Leordeni, Splaiul Unirii, Nr.9',
            'phone'=>'+40724 875 076',
            'role'=>'admin'
        ]);


        
       User::factory(100)->create();
    }
}
