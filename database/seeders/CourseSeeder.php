<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Courses categories
        DB::table('courses_categories')->insert([
            [
                'id' => 2,
                'name' => 'عبر الاتصال المرئي',
                'description' => 'zoom'
            ],
            [
                'id' => 12,
                'name' => 'مباشر - حضوري',
                'description' => 'مركز الملك عبدالعزيز الثقافي العالمي - اثراء'
            ],
            [
                'id' => 13,
                'name' => 'مباشر - وتبث عبر حساب الهيئة في منصة انستغرام',
                'description' => ''
            ],
            [
                'id' => 27,
                'name' => 'الصالون الإعلامي',
                'description' => ''
            ],
        ]);

        // Courses genders
        DB::table('courses_genders')->insert([
            [
                'id' => 3,
                'name' => 'الجنسان',
                'status' => 1,
                'description' => ''
            ],
            [
                'id' => 9,
                'name' => 'ذكور',
                'status' => 0,
                'description' => ''
            ],
            [
                'id' => 10,
                'name' => 'إناث',
                'status' => 0,
                'description' => ''
            ],
        ]);

        // Courses places
        DB::table('courses_places')->insert([
            [
                'id' => 4,
                'name' => 'الرياض',
                'description' => 'مقر الهيئة - حي الصحافة'
            ],
            [
                'id' => 14,
                'name' => 'الأحساء',
                'description' => 'قاعة 23 سبتمبر - قاعة 22 فبراير - المبرز'
            ],
            [
                'id' => 28,
                'name' => 'نجران',
                'description' => 'قاعة فندق جلوريا إن'
            ],
            [
                'id' => 29,
                'name' => 'الحدود الشمالية',
                'description' => 'قاعة هيئة الصحفيين السعوديين في عرعر'
            ],
            [
                'id' => 30,
                'name' => 'الجوف',
                'description' => 'مسرح جمعية الثقافة والفنون في سكاكا'
            ],
            [
                'id' => 31,
                'name' => 'الباحة',
                'description' => 'قاعة بلدية محافظة بلجرشي'
            ],
            [
                'id' => 33,
                'name' => 'حفر الباطن',
                'description' => 'مسرح غرفة حفرالباطن'
            ],
            [
                'id' => 34,
                'name' => 'عسير',
                'description' => 'قاعة نادي أبها الادبي'
            ],
            [
                'id' => 36,
                'name' => 'مكة المكرمة',
                'description' => ''
            ],
            [
                'id' => 37,
                'name' => 'جازان',
                'description' => ''
            ],
            [
                'id' => 39,
                'name' => 'الدمام',
                'description' => ''
            ],
            [
                'id' => 40,
                'name' => 'تبوك',
                'description' => ''
            ],
            [
                'id' => 41,
                'name' => 'القصيم',
                'description' => 'مسرح مركز التنمية الاجتماعية في بريدة'
            ],
            [
                'id' => 44,
                'name' => 'حائل',
                'description' => ''
            ],
            [
                'id' => 45,
                'name' => 'الجبيل',
                'description' => ''
            ],
            [
                'id' => 46,
                'name' => 'الطائف',
                'description' => ''
            ],
            [
                'id' => 47,
                'name' => 'المدينة المنورة',
                'description' => ''
            ],
        ]);


        // Courses types
        DB::table('courses_types')->insert([
            [
                'id' => 16,
                'name' => 'حلقة إثرائية',
                'description' => ''
            ],
            [
                'id' => 17,
                'name' => 'ورشة عمل',
                'description' => ''
            ],
            [
                'id' => 18,
                'name' => 'حلقة نقاش',
                'description' => ''
            ],
            [
                'id' => 19,
                'name' => 'برنامج تدريبي',
                'description' => ''
            ],
            [
                'id' => 20,
                'name' => 'ملتقى',
                'description' => ''
            ],
            [
                'id' => 21,
                'name' => 'مؤتمر صحفي',
                'description' => ''
            ],
            [
                'id' => 22,
                'name' => 'مؤتمر',
                'description' => ''
            ],
            [
                'id' => 23,
                'name' => 'ندوة',
                'description' => ''
            ],
            [
                'id' => 24,
                'name' => 'لقاء أخوي ترفيهي',
                'description' => ''
            ],
            [
                'id' => 25,
                'name' => 'حفل خطابي',
                'description' => ''
            ],
            [
                'id' => 26,
                'name' => 'الصالون الإعلامي',
                'description' => ''
            ],
        ]);
    }
}
