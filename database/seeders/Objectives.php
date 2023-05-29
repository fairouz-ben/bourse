<?php

namespace Database\Seeders;

use App\Models\Objective;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Objectives extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Objectives = [
            ['titre_ar' => 'حركية تحسين المستوى في الخارج قصيرة المدى','titre_fr' => 'Améliorer le niveau à l\'étranger à court terme','created_at'=>now()],
            ['titre_ar' => 'التظاهرات العلمية الدولية','titre_fr' => 'manifestations scientifiques internationales','created_at'=>now()],
            ['titre_ar' => 'الاقامة العلمية قصيرة المدى رفيعة المستوى','titre_fr' => 'Résidence académique de haut niveau à court terme','created_at'=>now()],
            ['titre_ar' => 'الاقامات في اطار التعاون الدولي','titre_fr' => 'Résidences dans le cadre de la coopération internationale','created_at'=>now()],
           
          ];
          foreach ($Objectives as $key => $value) {
            $Objective = Objective::create([
                'titre_ar' => $value['titre_ar'],
                'titre_fr' => $value['titre_fr'],
                'created_at' => $value['created_at']
            ]);

            
        }
    }
}
