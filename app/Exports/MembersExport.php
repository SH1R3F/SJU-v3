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
            __('Status'),
        ];
    }

    public function map($member): array
    {
        return [
            $member->id,
            $member->fullNameAr,
            $member->national_id,
            'Membership number',
            $member->email,
            $member->mobile,
            $member->subscription->type,
            $member->branch?->name,
            $member->subscription->status(),
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
        return Member::with('subscription', 'branch')
            // Only accepted members
            // ->whereIn('status', [Member::STATUS_ACCEPTED, Member::STATUS_DISABLED])
            ->filter(request())
            // ->when(branch manager, show only his branch's members) // To be added
            ->orderBy('id') // Might be dynamic too?
            ->get();
    }
}
