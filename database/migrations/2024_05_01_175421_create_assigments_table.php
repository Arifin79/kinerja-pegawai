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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('project_name')->nullable();
            $table->string('project_type')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_type')->nullable();
            $table->string('employee_name')->nullable();
            $table->date('deadline')->nullable();
            $table->string('file')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
