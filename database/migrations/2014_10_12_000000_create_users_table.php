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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom_ar');
            $table->string('prenom_ar');
            $table->string('nom_fr');
            $table->string('prenom_fr');
            $table->date('date_nais');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
           
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');   

           
            $table->unsignedBigInteger('relex_service_id');
            $table->foreign('relex_service_id')->references('id')->on('relex_services');
        
            $table->boolean('is_active')->default(true);
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
            $table->timestamps();

            $table->unique(["nom_ar", "prenom_ar","date_nais"], 'ar_nom_prenom_date_nais_unique');
            $table->unique(["nom_fr", "prenom_fr","date_nais"], 'fr_nom_prenom_date_nais_unique');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
