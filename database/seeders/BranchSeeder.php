<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::unguard();
        Branch::create(['name' => 'مكة المكرمة']);
        Branch::create(['name' => 'المدينة المنورة']);
        Branch::create(['name' => 'الأحساء']);
        Branch::create(['name' => 'الجبيل']);
        Branch::create(['name' => 'الدمام']);
        Branch::create(['name' => 'حائل']);
        Branch::create(['name' => 'حفر الباطن']);
        Branch::create(['name' => 'الرياض']);
        Branch::create(['name' => 'القصيم']);
        Branch::create(['name' => 'الباحة']);
        Branch::create(['name' => 'الجوف']);
        Branch::create(['name' => 'الحدود الشمالية']);
        Branch::create(['name' => 'عسير']);
        Branch::create(['name' => 'جازان']);
        Branch::create(['name' => 'نجران']);
        Branch::create(['name' => 'تبوك']);
        Branch::create(['id' => 18, 'name' => 'الطائف']);
    }
}
