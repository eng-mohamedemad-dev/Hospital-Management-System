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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('hospital');
            $table->text('about');
            // $table->string('working_time')->nullable();
            $table->string('str')->nullable(); // License number
            $table->integer('experience')->nullable();
            // $table->text('address')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('specialist_id')->constrained('specialists');

            // 📊 الحقول الجديدة
            $table->unsignedInteger('reviews_count')->default(0);
            $table->unsignedInteger('reviews_sum')->default(0);
            $table->decimal('reviews_avg', 8, 2)->default(0);

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
