<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUuidAndSoftDeletesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->uuid('uuid')->after('id')->comment('Public ID of the user');
            $table->softDeletes();

            // Unique
            $table->unique('email');

            // Indexes
            $table->index(['name', 'uuid']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('uuid');
            $table->dropIndex('name');
            $table->dropColumn('uuid');
            $table->dropSoftDeletes();
        });
    }
}
