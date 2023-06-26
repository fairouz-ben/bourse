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
        Schema::create('candidats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('grade_id');
            $table->foreign('grade_id')->references('id')->on('grades');

            $table->unsignedBigInteger('pays_id');
            $table->foreign('pays_id')->references('id')->on('pays');
            $table->string('pays_nom')->nullable();
            $table->unsignedBigInteger('objective_id');
            $table->foreign('objective_id')->references('id')->on('objectives');


            $table->string('fonction');
            $table->string('etablissement');
            $table->string('year_of_last_benefit')->nullable();
            
            $table->string('document')->nullable();
            $table->enum('etat' ,['Accepté','Refusé','Non traité','Acceptée sous réserve'])->default('Non traité');
            $table->mediumText('motif')->nullable();
            $table->string('remaque')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidats');
    }
};
