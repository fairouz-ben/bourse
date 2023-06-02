<?php

namespace Database\Seeders;

use App\Models\Doc_nom;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Doc_noms extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pays=[
            ['nom_ar'=>'طلب خطي ممضي من طرف المسؤول المباشر','nom_fr'=>'Une demande écrite signée par le supérieur direct','code'=>'doc_1'],
            ['nom_ar'=>'مقرر التعيين و شهادة عمل','nom_fr'=>'Décision de nomination et certificat de travail','code'=>'doc_2'],
            ['nom_ar'=>'شهادة','nom_fr'=>'Russie','code'=>'doc_3'],
            ['nom_ar'=>'نسخة من الصفحة الأولى لجواز السفر','nom_fr'=>'pasport','code'=>'doc_4'],
            ['nom_ar'=>'مشروع العمل ','nom_fr'=>'plan de travail','code'=>'doc_5'],
            ['nom_ar'=>'رسالة استقبال','nom_fr'=>'lettre accueil','code'=>'doc_6'],
           
            
            

        ];

        foreach ($pays as $key => $value) {
             Doc_nom::create([
                'nom_ar' => $value['nom_ar'],
                'nom_fr' => $value['nom_fr'],
                'code' => $value['code'],
                
            ]);

            
        }
    }
}
