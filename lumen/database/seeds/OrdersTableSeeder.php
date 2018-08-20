<?php

use CreateOrdersTable as Orders;
use CreateUsersTable as Users;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker): void
    {
        $users = DB::table(Users::TABLE) // 'users'
            ->select(Users::PK) // 'id'
            ->get();
        $orders = [];
        foreach ($users as $user) {
            for ($i = 0, $iMax = 5; $i < $iMax; ++$i) {
                $orders[] = [
                    'created_at' => $faker->dateTimeBetween($startDate = '-30 days', $endDate = 'now'),
                    Users::FK => $user->id, // 'user_id'
                ];
            }
        }
        usort($orders, function ($a, $b, $key = 'created_at') {
            return $a[$key] <=> $b[$key];
        });
        DB::table(Orders::TABLE) // 'orders'
            ->insert($orders);
    }
}
