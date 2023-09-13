<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code')->nullable();
            $table->string('description')->nullable();
            $table->longtext('image')->nullable();
            $table->decimal('price')->nullable();
            $table->integer('sub_category_id')->nullable();
            $table->string('shipping_days')->nullable();
            $table->tinyInteger('pick_up')->comment('1 Yes 0 No')->nullable();
            $table->tinyInteger('last_minute_shop')->comment('1 Yes 0 No')->nullable();
            $table->tinyInteger('is_liked')->comment('1 Yes 0 No')->nullable();
            $table->tinyInteger('is_in_cart')->comment('1 Yes 0 No')->nullable();
            $table->tinyInteger('is_active')->comment('1 Yes 0 No')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
