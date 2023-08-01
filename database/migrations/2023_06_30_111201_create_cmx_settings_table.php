<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('cmx_settings.table_prefix') . config('cmx_settings.table'), function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('key', 255);
            $table->text('value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('cmx_settings.table_prefix') . config('cmx_settings.table'));
    }
};
