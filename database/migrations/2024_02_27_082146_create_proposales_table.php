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
        Schema::create('proposales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->foreignId('project_id');
            $table->text('content');
            $table->string('time');
            $table->double('cost');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposales');
    }
};
