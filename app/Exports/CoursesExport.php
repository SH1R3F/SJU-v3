<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CoursesExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    private $courses;
    private $row = 0;

    public function __construct($courses)
    {
        $this->courses = $courses;
    }


    public function headings(): array
    {
        return [
            '#',
            __('Course'),
            __('Course number'),
            __('Course date'),
            __('Type'),
            __('Category'),
            __('Gender'),
            __('Branch'),
            __('Region'),
            __('Status'),
        ];
    }

    public function map($course): array
    {
        return [
            ++$this->row,
            app()->getLocale() == 'ar' ? $course->title_ar : $course->title_en,
            $course->course_number,
            $course->date_from,
            $course->course_type,
            $course->course_category,
            $course->course_gender,
            $course->course_branch,
            $course->region,
            __($course->state($course->status)),
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
        return $this->courses;
    }
}
