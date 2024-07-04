<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('total_rows')->nullable();
            $table->integer('total_cols')->nullable();
            $table->decimal('price_standard', 8, 2)->nullable();
            $table->decimal('price_vip', 8, 2)->nullable();
            $table->boolean('is_started_sales')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('halls');
    }
};
