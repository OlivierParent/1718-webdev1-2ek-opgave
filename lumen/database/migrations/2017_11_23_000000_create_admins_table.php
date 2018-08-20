<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    const TABLE = 'admins';
    const PK = 'id';
    const FK = 'admin_id';
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
                ->comment = 'Username.';
            $table->string('email')
                ->unique()
                ->comment = 'Email must be unique.';
            $table->string('password')
                ->comment = 'Stores password hash.';
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
