<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiecesTable extends Migration
{
    const TABLE = 'pieces';
    const PK = 'id';
    const FK = 'piece_id';
    const TABLE_PK = self::TABLE . '.' . self::PK;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            // Meta data
            $table->increments(self::PK);
            $table->timestamps();
            $table->timestamp('deleted_at')
                ->nullable()
                ->comment = 'Soft delete.';

            // Data
            $table->string('name')
                ->comment = 'Piece of clothing name.';
            $table->string('description')
                ->comment = 'Description of the piece of clothing.';
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
