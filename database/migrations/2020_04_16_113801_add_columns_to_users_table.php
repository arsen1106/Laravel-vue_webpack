<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->unique()->index()->nullable();
            $table->string('surname')->nullable();
            $table->longText('cover_photo')->nullable();
            $table->enum('role',[0,1,-1])->default(0)->comment('-1 for super admin, 1 for admin, 0 for user');
            $table->enum('status',[0,1])->default(0)->comment('1 for approved, 0 for pending');
            $table->enum('gender',[0,1])->default(0)->comment('0 for female, 1 for male');
            $table->softDeletes();
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
            //
        });
    }
}
