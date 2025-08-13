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
        // Get maximum number of documents to create appropriate headers
        $maxDocs = 0;
        foreach ($this->registrations as $reg) {
            $docCount = count($reg->documents_list);
            if ($docCount > $maxDocs) {
                $maxDocs = $docCount;
            }
        }

        $headers = ['Name', 'Email', 'Phone', 'Disability Category', 'Games'];
        
        // Add document columns
        for ($i = 1; $i <= $maxDocs; $i++) {
            $headers[] = "Document " . $i;
        }
        
        return $headers;
    }

    public function map($registration): array
    {
        $row = [
            $registration->athlete_name,
            $registration->email,
            $registration->phone,
            $registration->disability,
            $registration->games_list,
        ];

        // Add document URLs
        foreach ($registration->documents_list as $docUrl) {
            $row[] = $docUrl; // Full public URL
        }

        return $row;
    }
}