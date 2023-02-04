<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class VolunteersExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{

    private $volunteers;
    private $row = 0;

    public function __construct($volunteers)
    {
        $this->volunteers = $volunteers;
    }


    public function headings(): array
    {
        return [
            '#',
            __('Full name'),
            __('National ID number'),
            __('Email'),
            __('Mobile'),
            __('Courses'),
            __('Status'),
        ];
    }

    public function map($volunteer): array
    {
        return [
            ++$this->row,
            $volunteer->fullNameAr,
            $volunteer->national_id,
            $volunteer->email,
            "+{$volunteer->mobile_key}{$volunteer->mobile}",
            $volunteer->courses_count,
            $volunteer->status == 1 ? __('Active') : __('Inactive'),
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
        return $this->volunteers;
    }
}
