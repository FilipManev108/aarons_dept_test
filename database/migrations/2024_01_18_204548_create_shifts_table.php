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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->integer('hours');
            $table->float('rate_per_hour');
            $table->integer('total_pay');
            $table->boolean('taxable');
            $table->dateTime('paid_at')->nullable();
            $table->foreignId('status_id')->references('id')->on('statuses');
            $table->foreignId('shift_type_id')->references('id')->on('shift_types');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('company_id')->references('id')->on('companies');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
