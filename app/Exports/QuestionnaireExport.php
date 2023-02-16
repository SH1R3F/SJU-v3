<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class QuestionnaireExport implements FromArray, WithHeadings, WithMapping, WithEvents
{
    private $answers;
    private $questions;
    private $row = 0;

    public function __construct(array $data)
    {
        $this->answers = $data['answers'];
        $this->questions = $data['questions'];
    }


    public function headings(): array
    {
        return array_merge(
            [
                '#',
                __('Name'),
                __('Type'),
            ],
            array_map(fn ($question) => $question['question'], $this->questions)
        );
    }

    public function map($answer): array
    {
        return array_merge(
            [
                ++$this->row,
                $answer['name'],
                $answer['type'],
            ],
            array_map(fn ($question) => $answer['answers'][$question['id']], $this->questions)
        );
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
    public function array(): array
    {
        return $this->answers;
    }
}
