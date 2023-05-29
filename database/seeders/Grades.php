<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Grades extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Grades=[
            ['titre_ar'=>'الاساتذة الباحثون:أستاذإستشفائي جامعي','titre_fr'=>'prof.H-U'],
            ['titre_ar'=>' أستاذ محاضر أإستشفائي جامعي','titre_fr'=>'MCA H-U'],
            ['titre_ar'=>'أستاذ محاضر ب إستشفائي جامعي','titre_fr'=>'MCB H-U'],
            ['titre_ar'=>'أستاذ مساعد إستشفائي جامعي','titre_fr'=>'MA H-U'],
            ['titre_ar'=>'أستاذ التعليم العالي','titre_fr'=>'Prof.'],
            ['titre_ar'=>'أستاذ محاضر أ','titre_fr'=>'MCA'],
            ['titre_ar'=>'أستاذ محاضر ب','titre_fr'=>'MCB'],
            ['titre_ar'=>'أستاذ مساعد أ','titre_fr'=>'MAA'],
            ['titre_ar'=>'أستاذ مساعد ب','titre_fr'=>'MAB'],
            ['titre_ar'=>'طالب دكتوراه','titre_fr'=>'DR'],
            ['titre_ar'=>'أستاذ باحث أ','titre_fr'=>'MRA'],
            ['titre_ar'=>'أستاذ باحث ب','titre_fr'=>'MRB'],
            ['titre_ar'=>'ملحق بالبحث','titre_fr'=>'AR'],
            ['titre_ar'=>'مكلف بالبحث','titre_fr'=>'CR'],

            ['titre_ar'=>'طالب الدكتوراه غير الأجراء الطور الثالث ل م د','titre_fr'=>'3 cycle-LMD'],
            ['titre_ar'=>'طالب الدكتوراه غير الأجراء الكلاسيكي','titre_fr'=>'Classique'],

            ['titre_ar'=>'موظف إداري','titre_fr'=>'Administratifs'],
            ['titre_ar'=>'موظف تقني','titre_fr'=>'Techniques'],
            

        ];

        foreach ($Grades as $key) {
            $g = Grade::create($key); 
        }
    }
}
