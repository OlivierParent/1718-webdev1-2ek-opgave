<?php

use CreateOutfitsTable as Outfits;
use CreatePiecesTable as Pieces;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutfitPieceTable extends Migration
{
    const TABLE = 'outfit_piece';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            // Meta data
            $table->unsignedInteger(Outfits::FK);
            $table->unsignedInteger(Pieces::FK);
            $table->primary([
                Pieces::FK,
                Outfits::FK,
            ]);

            // Relationships
            $table->foreign(Outfits::FK)
                ->references(Outfits::PK)
                ->on(Outfits::TABLE);
            $table->foreign(Pieces::FK)
                ->references(Pieces::PK)
                ->on(Pieces::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE);
    }
}
