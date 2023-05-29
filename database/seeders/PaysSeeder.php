<?php

namespace Database\Seeders;

use App\Models\Pays;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pays=[
            ['nom_ar'=>'الإتحاد الأروبي','nom_fr'=>'Union Européenne','zone'=>'1'],
            ['nom_ar'=>'الولايات المتحدة الأمريكية','nom_fr'=>'Etat-Unis d\'Amérique','zone'=>'1'],
            ['nom_ar'=>'روسيا','nom_fr'=>'Russie','zone'=>'1'],
            ['nom_ar'=>'سويسرا','nom_fr'=>'Suisse','zone'=>'1'],
            ['nom_ar'=>'الصين','nom_fr'=>'Chine','zone'=>'1'],
            ['nom_ar'=>'كوريا','nom_fr'=>'Corée','zone'=>'1'],
            ['nom_ar'=>'الإمارات العربية المتحدة','nom_fr'=>'Emirats Arabes','zone'=>'1'],
            ['nom_ar'=>'الأردن','nom_fr'=>'Jordanie','zone'=>'1'],
            ['nom_ar'=>'الكويت','nom_fr'=>'Koweit','zone'=>'1'],
            ['nom_ar'=>'اسبانيا','nom_fr'=>'Espagne','zone'=>'1'],
            ['nom_ar'=>'استونيا','nom_fr'=>'Estonie','zone'=>'1'],
            ['nom_ar'=>'تونس','nom_fr'=>'Tunis','zone'=>'2'],
            ['nom_ar'=>'مصر','nom_fr'=>'Eypt','zone'=>'2'],
            ['nom_ar'=>'ليبيا','nom_fr'=>'Liebi','zone'=>'2'],
            ['nom_ar'=>'جنوب أفريقيا','nom_fr'=>'Afrique du Sud','zone'=>'2'],
            ['nom_ar'=>'العراق','nom_fr'=>'Irak','zone'=>'2'],
            
            

        ];

        foreach ($pays as $key => $value) {
            $p = Pays::create([
                'nom_ar' => $value['nom_ar'],
                'nom_fr' => $value['nom_fr'],
                'zone' => $value['zone']
            ]);

            
        }
    }
}
