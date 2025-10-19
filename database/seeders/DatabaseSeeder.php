<?php

namespace Database\Seeders;

use App\Models\Appoinment;
use App\Models\MedicalRecord;
use App\Models\MedicalService;
use App\Models\Patient;
use App\Models\SessionTherapy;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         //User::factory(5)->create();
         //MedicalService::factory(5)->create();
         //Patient::factory(15)->create();
         //Appoinment::factory(25)->create();
         //MedicalRecord::factory(10)->create();  
         //Treatment::factory(10)->create();
         SessionTherapy::factory(40)->create();

       /*  User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
    }
}
