<?php

use CreateUsersTable as Users;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker): void
    {
        $users = [];
        $users[] = [
            'created_at' => new DateTime(),
            'name' => 'Test User',
            'email' => 'user@gdm.gent',
            'password' => password_hash('secret', PASSWORD_DEFAULT),
        ];
        for ($i = 0, $iMax = 9; $i < $iMax; ++$i) {
            $users[] = [
                'created_at' => $faker->dateTimeBetween($startDate = '-12 months', $endDate = 'now'),
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => password_hash($faker->password, PASSWORD_DEFAULT),
            ];
        }
        usort($users, function ($a, $b, $key = 'created_at') {
            return $a[$key] <=> $b[$key];
        });
        DB::table(Users::TABLE) // 'users'
            ->insert($users);
    }
}
