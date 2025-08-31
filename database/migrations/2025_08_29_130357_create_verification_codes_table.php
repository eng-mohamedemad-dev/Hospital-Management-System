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
        Schema::create('verification_codes', function (Blueprint $table) {
            $table->id();
            $table->morphs('user'); // user_type and user_id
            $table->string('code')->nullable();
            $table->string('token')->nullable();
            $table->string('type')->default('email_verification'); // email_verification, password_reset
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();

            $table->index(['user_type', 'user_id'], 'verification_codes_user_idx');
            $table->index(['token', 'type'], 'verification_codes_token_type_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verification_codes');
    }
};
