<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubscribersExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{

    private $subscribers;
    private $row = 0;

    public function __construct($subscribers)
    {
        $this->subscribers = $subscribers;
    }


    public function headings(): array
    {
        return [
            '#',
            __('Full name'),
            __('Email'),
            __('Mobile'),
            __('Courses'),
            __('Status'),
        ];
    }

    public function map($subscriber): array
    {
        return [
            ++$this->row,
            $subscriber->fullNameAr,
            $subscriber->email,
            "+{$subscriber->mobile_key}{$subscriber->mobile}",
            $subscriber->courses_count,
            $subscriber->status == 1 ? __('Active') : __('Inactive'),
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
        return $this->subscribers;
    }
}
