<?php

use CreatePiecesTable as Pieces;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class PiecesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker): void
    {
        $pieces = [
            ['name' => 'casual jacket'],
            ['name' => 'flight jacket'],
            ['name' => 'down jacket'],
            ['name' => 'comfort jacket'],
            ['name' => 'jacket blazer'],
            ['name' => 'cotton slim fit jacket'],
            ['name' => 'long sleeve sweater'],
            ['name' => 'v-neck sweater'],
            ['name' => 'stretch jeans'],
            ['name' => 'ultra stretch jeans'],
            ['name' => 'regular fit jeans'],
            ['name' => 'skinny fit jeans'],
            ['name' => 'chelsea boots'],
            ['name' => 'plimsolls'],
            ['name' => 'trainers'],
            ['name' => 'espadrilles'],
            ['name' => 'sliders'],
            ['name' => 'loafers'],
            ['name' => 'boat shoes'],
            ['name' => 'derby shoes'],
            ['name' => 'polo shirt'],
            ['name' => 'long sleeve shirt'],
            ['name' => 'slim fit shirt'],
            ['name' => 'skinny fit shirt'],
            ['name' => 'denim shirt'],
            ['name' => 'regular fit shirt'],
            ['name' => 'short sleeve shirt'],
            ['name' => 'socks'],
            ['name' => 'belt'],
            ['name' => 'hat'],
            ['name' => 'T-shirt'],
            ['name' => 'linnen cotton coat'],
            ['name' => 'collar coat'],
            ['name' => 'short coat'],
            ['name' => 'hooded coat'],
        ];
        for ($i = 0, $iMax = count($pieces); $i < $iMax; ++$i) {
            $pieces[$i]['created_at'] = $faker->dateTimeBetween($startDate = '-12 months', $endDate = 'now');
            $pieces[$i]['description'] = $faker->text($maxNbChars = mt_rand(100, 300));
        }
        usort($pieces, function ($a, $b, $key = 'created_at') {
            return $a[$key] <=> $b[$key];
        });
        DB::table(Pieces::TABLE) // 'pieces'
            ->insert($pieces);
    }
}
