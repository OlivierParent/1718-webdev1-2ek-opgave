<?php

use CreateAdminsTable as Admins;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker): void
    {
        $admins = [];
        $admins[] = [
            'created_at' => new DateTime(),
            'name' => 'Admin',
            'email' => 'admin@gdm.gent',
            'password' => password_hash('secret', PASSWORD_DEFAULT),
        ];
        DB::table(Admins::TABLE) // 'admins'
            ->insert($admins);
    }
}
