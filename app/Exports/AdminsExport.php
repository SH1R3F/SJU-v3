<?php

namespace App\Exports;

use App\Models\Admin;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AdminsExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{

    private $row = 0;

    public function headings(): array
    {
        return [
            '#',
            __('Full name'),
            __('Username'),
            __('Email'),
            __('Mobile'),
            __('Role'),
            __('Branch'),
        ];
    }

    public function map($admin): array
    {
        return [
            ++$this->row,
            $admin->fullName,
            $admin->username,
            $admin->email,
            $admin->mobile,
            count($admin->getRoleNames('name')) ? __($admin->getRoleNames('name')[0]) : '',
            $admin->branch?->name,
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Admin::with('branch', 'roles')->whereHas('roles', fn($query) => $query->whereNot('name', 'Employee'))->get();
    }
}
