<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('daily_diners', function (Blueprint $table) {
            $table->integer('order')->nullable();
        });
    }

    public function down()
    {
        Schema::table('daily_diners', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
