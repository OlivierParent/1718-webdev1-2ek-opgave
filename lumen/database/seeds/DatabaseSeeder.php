<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(AdminsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(OutfitsTableSeeder::class);
        $this->call(PiecesTableSeeder::class);
        $this->call(OutfitPieceTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderOutfitTableSeeder::class);
    }
}
