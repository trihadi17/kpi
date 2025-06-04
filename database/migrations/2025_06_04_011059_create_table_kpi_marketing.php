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
        Schema::create('table_kpi_marketing', function (Blueprint $table) {
            $table->id();
            $table->string('tasklist', 100)->nullable();
            $table->string('kpi', 100)->nullable();
            $table->string('karyawan', 100)->nullable();
            $table->date('deadline')->nullable();
            $table->date('aktual')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_kpi_marketing');
    }
};
