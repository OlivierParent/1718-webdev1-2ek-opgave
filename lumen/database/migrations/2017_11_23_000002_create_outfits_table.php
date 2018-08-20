<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutfitsTable extends Migration
{
    const TABLE = 'outfits';
    const PK = 'id';
    const FK = 'outfit_id';
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
                ->comment = 'Outfit name.';
            $table->text('description')
                ->comment = 'Description of the outfit.';
            $table->decimal('price')
                ->comment = 'Current price of a outfit.';
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
