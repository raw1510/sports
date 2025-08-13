<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DisabilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $disabilities = [
            'Blindness',
            'Low Vision',
            'Leprosy Cured Persons',
            'Hearing Impairment (Deaf and Hard of Hearing)',
            'Locomotor Disability',
            'Dwarfism',
            'Intellectual Disability',
            'Mental Illness',
            'Autism Spectrum Disorder',
            'Cerebral Palsy',
            'Muscular Dystrophy',
            'Chronic Neurological Conditions',
            'Specific Learning Disabilities',
            'Multiple Sclerosis',
            'Speech and Language Disability',
            'Thalassemia',
            'Hemophilia',
            'Sickle Cell Disease',
            'Multiple Disabilities (more than one of the above specified disabilities)',
            'Acid Attack Victim',
            'Parkinson\'s Disease',
        ];

        $timestamp = Carbon::now();

        foreach ($disabilities as $disability) {
            DB::table('disability')->insert([
                'disability_name'  => $disability,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }
    }
}