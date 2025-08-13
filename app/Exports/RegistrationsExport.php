<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RegistrationsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $registrations;

    public function __construct($registrations)
    {
        $this->registrations = $registrations;
    }

    public function collection()
    {
        return $this->registrations;
    }

    public function headings(): array
    {
        return [
            'Surname',
            'Full name',
            'Father\'s name',
            'Date Of Birth',
            'Percentage',
            'Genter',
            'Age Group',
            'Email',
            'Phone',
            'Disability Category',
            'Games',
            'Documents'
        ];
    }

    public function map($registration): array
    {
        return [
            $registration->surname,
            $registration->athlete_name,
            $registration->father_name,
            $registration->dob,
            $registration->percentage,
            $registration->gender,
            $registration->age_group,
            $registration->email,
            $registration->phone,
            $registration->disability,
            $registration->games_list,
            implode(', ', array_map('basename', $registration->documents_list))
        ];
    }
}