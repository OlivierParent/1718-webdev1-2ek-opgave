<?php

use CreateOrdersTable as Orders;
use CreateOrderOutfitTable as OrderOutfit;
use CreateOutfitsTable as Outfits;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class OrderOutfitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $orders = DB::table(Orders::TABLE) // 'orders'
            ->select(
                Orders::PK, // 'id'
                'created_at'
            )
            ->get();
        $outfits = DB::table(Outfits::TABLE) // 'outfits'
            ->select(
                Outfits::PK, // 'id'
                'price'
            )
            ->get()
            ->toArray();
        $orderOutfitSet = [];
        foreach ($orders as $order) {
            $total = 0;
            $outfitsKinds = mt_rand(1,5); // Mersenne Twister Algorithm
            $outfitSubset = array_random($outfits, $outfitsKinds);
            foreach ($outfitSubset as $outfit) {
                $quantity = mt_rand(1,10);
                $total += $quantity * $outfit->price;
                $orderOutfitSet[] = [
                    Orders::FK => $order->id,          // 'order_id'
                    Outfits::FK => $outfit->id,        // 'outfit_id'
                    'created_at' => $order->created_at,
                    'price' => $outfit->price,
                    'quantity' => $quantity,
                ];
            }
            DB::table(Orders::TABLE) // 'orders'
                ->where(Orders::PK, $order->id) // 'id'
                ->update([
                    'updated_at' => $order->created_at,
                    'total' => $total,
                ]);
        }
        DB::table(OrderOutfit::TABLE) // 'order_outfit'
            ->insert($orderOutfitSet);
    }
}
