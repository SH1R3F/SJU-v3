<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvitesExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    private $invitations;
    private $row = 0;

    public function __construct($invitations)
    {
        $this->invitations = $invitations;
    }


    public function headings(): array
    {
        return [
            '#',
            __('Full name'),
            __('Email'),
            __('Passed'),
        ];
    }

    public function map($invitation): array
    {
        return [
            ++$this->row,
            $invitation->name,
            $invitation->email,
            $invitation->scanned ? __('Passed') : __('Didn\'t pass')
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
        return $this->invitations;
    }
}
