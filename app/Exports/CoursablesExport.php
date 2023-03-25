<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CoursablesExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{

    private $course;
    private $row = 0;

    public function __construct($course)
    {
        $this->course = $course;
    }


    public function headings(): array
    {
        return [
            '#',
            __('Name'),
            __('Type'),
            __('Mobile'),
            __('Email'),
            __('Passed'),
        ];
    }

    public function map($user): array
    {
        return [
            ++$this->row,
            $user->full_name,
            match ($user->pivot->coursable_type) {
                'App\Models\Member' => __('Member'),
                'App\Models\Subscriber' => __('Subscriber'),
                'App\Models\Volunteer' => __('Volunteer'),
            },
            $user->prepareMobileForSms(),
            $user->email,
            $user->pivot->attendance ? __('Yes') : __('No'),
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
        return $this->course->members->mergeRecursive($this->course->subscribers)->mergeRecursive($this->course->volunteers);
    }
}
