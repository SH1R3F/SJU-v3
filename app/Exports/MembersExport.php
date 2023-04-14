<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class MembersExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{

    private $members;
    private $row = 0;

    public function __construct($members)
    {
        $this->members = $members;
    }

    public function headings(): array
    {
        return [
            '#',
            __('Full name'),
            __('National ID number'),
            __('Membership number'),
            __('Email'),
            __('Mobile'),
            __('Membership type'),
            __('Branch'),
            __('Employer'),
            __('Status')
        ];
    }

    public function map($member): array
    {
        return [
            ++$this->row,
            $member->fullNameAr,
            $member->national_id,
            $member->membership_number,
            $member->email,
            $member->mobile,
            __(config('sju.memberships')[$member->subscription->type]['name']),
            $member->branch?->name,
            $member->journalistic_employer,
            $member->status()
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
        return $this->members;
    }
}
