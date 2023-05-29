<?php

namespace Database\Seeders;
use App\Models\Relex_service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Relex_services extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['id' => 1,'name_ar' => 'رئاسة الجامعة','name_fr' => 'Rectorat','created_at' => '2022-09-22 15:05:01'],
            ['id' => 2,'name_ar' => 'الحقوق','name_fr' => 'Droit','created_at' => '2022-09-22 15:05:01'],
            ['id' => 3,'name_ar' => 'العلوم الإسلامية','name_fr' => 'sciences islamique','created_at' => '2022-09-22 15:06:25'],
            ['id' => 4,'name_ar' => 'الطب','name_fr' => 'Médecine','created_at' => '2022-09-22 15:07:18'],
            ['id' => 5,'name_ar' => 'الصيدلة','name_fr' => 'Pharmacie','created_at' => '2022-09-22 15:08:04'],
            ['id' => 6,'name_ar' => 'كلية العلوم','name_fr' => 'Faculté des sciences','created_at' => '2022-09-23 13:22:17']
          ];
          foreach ($services as $item) {
            Relex_service::updateOrCreate(['id' => $item['id']], $item);
          }
    }
}
