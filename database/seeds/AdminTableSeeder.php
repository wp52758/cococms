<?php


class AdminTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('admins')->insert([
            'user_name' => SUPER_ADMINISTRATOR,
            'password' => password_hash('cococms', PASSWORD_BCRYPT),
            'state' => 1,
        ]);
    }
}