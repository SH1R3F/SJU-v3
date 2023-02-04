<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SupportTicketsExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{

    private $tickets;
    private $row = 0;

    public function __construct($tickets)
    {
        $this->tickets = $tickets;
    }


    public function headings(): array
    {
        return [
            '#',
            __('Ticket title'),
            __('User'),
            __('Mobile'),
            __('Status'),
            __('Last update'),
        ];
    }

    public function map($ticket): array
    {
        return [
            ++$this->row,
            $ticket->title,
            $ticket->supportable->full_name,
            $ticket->supportable->prepareMobileForSms(),
            $ticket->status ?  __('Closed') : __('Open'),
            $ticket->updated_at,
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
        return $this->tickets;
    }
}
