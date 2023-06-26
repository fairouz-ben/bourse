<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW view_candidats AS
            select candidats.id,candidats.year_of_last_benefit, candidats.is_deleted, candidats.pays_nom, candidats.etat ,users.nom_ar AS nom_ar,users.prenom_ar AS prenom_ar , users.email, users.phone , users.relex_service_id as relex_service_id ,grades.titre_ar AS grade_titre_ar, objectives.titre_ar as objective_titre_ar from users join candidats join grades JOIN objectives where ((grades.id = candidats.grade_id) and (users.id = candidats.user_id) and (objectives.id = candidats.objective_id))
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS view_candidats;");
    }
};
