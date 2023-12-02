<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CandidatesExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{

    private $candidates;
    private $row = 0;

    public function __construct($candidates)
    {
        $this->candidates = $candidates;
    }


    public function headings(): array
    {
        return [
            '#',
            __('Full name'),
            __('National ID number'),
            __('Votes'),
        ];
    }

    public function map($candidate): array
    {
        return [
            ++$this->row,
            $candidate->candidate->fullNameAr,
            $candidate->candidate->national_id,
            $candidate->votes_count,
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->candidates;
    }
}
