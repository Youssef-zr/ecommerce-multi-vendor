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
        Schema::create('paypal_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('account_mode', ['sandbox', 'live'])->default('sandbox');
            $table->string('country_name');
            $table->string('currency_name');
            $table->string('currency_rate');
            $table->string('sandbox_client_id');
            $table->string('sandbox_secret_key');
            $table->string('live_client_id');
            $table->string('live_secret_key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paypal_settings');
    }
};
