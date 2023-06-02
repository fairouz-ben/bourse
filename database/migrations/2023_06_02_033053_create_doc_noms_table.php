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
        Schema::create('doc_noms', function (Blueprint $table) {
            $table->id();
            $table->string('nom_ar')->unique();
            $table->string('nom_fr')->unique();
            $table->string('code')->unique();
            $table->string('groupe')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doc_noms');
    }
};
