<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Member;
use App\Events\MemberRegistered;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class MembersImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        // Delete first row
        $rows->shift();

        $branches = Branch::pluck('id', 'name');

        foreach ($rows as $row) {
            if (count($row) < 15) {
                logger('Importing skipped row count is ' . count($row));
                continue;
            }

            [$name_ar, $name_en, $gender, $national_id, $mobile, $birthday_h, $birthday_m, $branch, $qualification, $major, $journalistic_profession, $journalistic_employer, $newspaper_type, $email, $type] = $row;


            if(empty($national_id ?? '')) {
                logger('Importing skipped row national_id is empty');
                continue;
            }

            if (!$branch || !$branches[$branch]) {
                logger("Skipped $national_id because no branch ({$branch})");
                continue;
            }

            try {
                $member = Member::firstOrCreate(['national_id' => $national_id], [
                    // Name ar
                    ...$this->name($name_ar ?? '', 'ar'),
                    // Name en
                    ...$this->name($name_en ?? '', 'en'),
                    'gender' => $gender == 'ذكر' ? 0 : 1,
                    'birthday_h' => Carbon::createFromFormat('d/m/Y', $birthday_h),
                    'birthday_m' => Carbon::createFromFormat('d/m/Y', $birthday_m),
                    'nationality' => 'SA',
                    'qualification' => $qualification ?? ' ',
                    'major' => $major ?? ' ',
                    'journalistic_profession' => $journalistic_profession ?? ' ',
                    'journalistic_employer' => $journalistic_employer ?? ' ',
                    'newspaper_type' => $newspaper_type == 'صحيفة ورقية' ? 1 : 2,
                    'non_journalistic_profession' => ' ',
                    'non_journalistic_employer' => ' ',
                    'workphone' => 0,
                    'workphone_ext' => 0,
                    'branch_id' => $branches[$branch],
                    'email' => $email,
                    'mobile' => "966$mobile",
                    'mobile_verified_at' => now(),
                    'password' => bcrypt('123456')
                ]);

                // Create subscription
                if (!$member->subscription) {
                    $member->subscription()->create(['type' => $type == 'عضو متفرغ' ? 1 : ($type == 'عضو غير متفرغ' ? 2 : 3), 'end_date' => Carbon::now()->endOfYear()]);
                }
            } catch (\Exception $e) {
                logger("$national_id had error importing " . $e->getMessage());
            }
        }
    }

    private function name(string $name, string $locale): array
    {
        $bits = explode(' ', $name);

        if (count($bits) == 1) {
            return [
                "fname_$locale" => $bits[0],
                "sname_$locale" => ' ',
                "tname_$locale" => ' ',
                "lname_$locale" => ' ',
            ];
        }

        if (count($bits) == 2) {
            return [
                "fname_$locale" => $bits[0],
                "sname_$locale" => $bits[1],
                "tname_$locale" => ' ',
                "lname_$locale" => ' ',
            ];
        }

        if (count($bits) == 3) {
            return [
                "fname_$locale" => $bits[0],
                "sname_$locale" => $bits[1],
                "tname_$locale" => $bits[2],
                "lname_$locale" => ' ',
            ];
        }

        return [
            "fname_$locale" => $bits[0],
            "sname_$locale" => $bits[1],
            "tname_$locale" => $bits[2],
            "lname_$locale" => $bits[3],
        ];
    }
}
