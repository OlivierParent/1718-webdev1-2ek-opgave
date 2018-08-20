<?php

use CreateOrdersTable as Orders;
use CreateOutfitsTable as Outfits;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderOutfitTable extends Migration
{
    const TABLE = 'order_outfit';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            // Meta data
            $table->unsignedInteger(Orders::FK);
            $table->unsignedInteger(Outfits::FK);
            $table->primary([
                Orders::FK,
                Outfits::FK,
            ]);
            $table->timestamps();

            // Relationships
            $table->foreign(Orders::FK)
                ->references(Orders::PK)
                ->on(Orders::TABLE);
            $table->foreign(Outfits::FK)
                ->references(Outfits::PK)
                ->on(Outfits::TABLE);

            // Data
            $table->smallInteger('quantity')
                ->comment = 'Quantity of outfits.';
            $table->decimal('price')
                ->comment = 'Unit price of outfit at time of order.';
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
