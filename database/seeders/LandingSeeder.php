<?php

use Illuminate\Database\Seeder;
use app\Models\User;
class LandingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'rvnz45',
            'password' => bcrypt('112233>!'),
        ]);
    }
}
