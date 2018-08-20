<?php

use CreatePiecesTable as Pieces;
use CreateOutfitPieceTable as OutfitPiece;
use CreateOutfitsTable as Outfits;
use Illuminate\Database\Seeder;

class OutfitPieceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $pieces = DB::table(Pieces::TABLE) // 'pieces'
            ->select(Pieces::PK) // 'id'
            ->get()
            ->toArray();
        $outfits = DB::table(Outfits::TABLE) // 'outfits'
            ->select(Outfits::PK) // 'id'
            ->get()
            ->toArray();
        $pieceOutfitSet = [];
        foreach ($outfits as $outfit) {
            $piecesSubset = array_random($pieces, mt_rand(3, 7));
            foreach ($piecesSubset as $piece) {
                $pieceOutfitSet[] = [
                    Outfits::FK => $outfit->id, // 'outfit_id'
                    Pieces::FK => $piece->id,   // 'piece_id'
                ];
            }
        }
        DB::table(OutfitPiece::TABLE) // 'outfit_piece'
            ->insert($pieceOutfitSet);
    }
}
