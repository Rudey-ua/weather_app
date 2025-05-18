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
        Schema::create('weather_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('city');
            $table->enum('frequency', ['hourly', 'daily']);

            $table->string('token');
            $table->boolean('subscription_confirmed')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_subscriptions');
    }
};
