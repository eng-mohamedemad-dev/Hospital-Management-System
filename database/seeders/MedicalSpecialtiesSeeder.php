<?php

namespace Database\Seeders;

use App\Models\Specialist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalSpecialtiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            'General Medicine',
            'Internal Medicine',
            'Cardiology',
            'Neurology',
            'Orthopedics',
            'Dermatology',
            'Pediatrics',
            'Obstetrics and Gynecology',
            'Ophthalmology',
            'Otolaryngology (ENT)',
            'Psychiatry',
            'Radiology',
            'Anesthesiology',
            'Pathology',
            'Urology',
            'Nephrology',
            'Gastroenterology',
            'Endocrinology',
            'Hematology',
            'Oncology',
            'Pulmonology',
            'Rheumatology',
            'Emergency Medicine',
            'Family Medicine',
            'Plastic Surgery',
            'General Surgery',
            'Vascular Surgery',
            'Neurosurgery',
            'Cardiothoracic Surgery',
            'Dental Medicine',
            'Physical Therapy',
            'Occupational Therapy',
            'Rehabilitation Medicine',
            'Sports Medicine',
            'Infectious Diseases',
            'Geriatrics',
            'Allergy and Immunology',
            'Nuclear Medicine',
            'Clinical Pharmacology',
        ];
        foreach($specialties as $specialty){
            Specialist::create(['name' => $specialty]);
        }
    }
}
