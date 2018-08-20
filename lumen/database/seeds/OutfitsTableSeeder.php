<?php

use CreateOutfitsTable as Outfits;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class OutfitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker): void
    {
        $outfits = [
            ['name' => 'Melbourne'],
            ['name' => 'Amsterdam'],
            ['name' => 'Moscow'],
            ['name' => 'Vancouver'],
            ['name' => 'Berlin'],
            ['name' => 'Antwerp'],
            ['name' => 'Stockholm'],
            ['name' => 'Los Angeles'],
            ['name' => 'Copenhagen'],
            ['name' => 'Milan'],
            ['name' => 'Seoul'],
            ['name' => 'London'],
            ['name' => 'Tokyo'],
            ['name' => 'Paris'],
            ['name' => 'New York'],
        ];
        $decimals = [
            .49,
            -.01,
        ];
        for ($i = 0, $iMax = count($outfits); $i < $iMax; ++$i) {
            $outfits[$i]['created_at'] = $faker->dateTimeBetween($startDate = '-12 months', $endDate = 'now');
            $outfits[$i]['price'] = mt_rand(10,30) * 5 + array_random($decimals);
            $outfits[$i]['description'] = $faker->text($maxNbChars = mt_rand(100, 300));
        }
        usort($outfits, function ($a, $b, $key = 'created_at') {
            return $a[$key] <=> $b[$key];
        });
        DB::table(Outfits::TABLE) // 'outfits'
            ->insert($outfits);
    }
}
