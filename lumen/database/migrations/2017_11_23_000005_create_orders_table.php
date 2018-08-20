<?php

use CreateUsersTable as Users;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    const TABLE = 'orders';
    const PK = 'id';
    const FK = 'order_id';
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

            // Relationships
            $table->unsignedInteger(Users::FK);
            $table->foreign(Users::FK)
                ->references(Users::PK)
                ->on(Users::TABLE);

            // Data
            $table->decimal('total')
                ->comment = 'Total price of order (as check).';
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
