<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed categories
        Category::updateOrCreate(['id' => 1], ['id' => 1, 'title_ar' => 'حفر الباطن', 'title_en' => 'Hafar Al-Batin']);
        Category::updateOrCreate(['id' => 2], ['id' => 2, 'title_ar' => 'الأحساء', 'title_en' => 'Hasa']);
        Category::updateOrCreate(['id' => 3], ['id' => 3, 'title_ar' => 'حائل', 'title_en' => 'Hail']);
        Category::updateOrCreate(['id' => 4], ['id' => 4, 'title_ar' => 'الجبيل', 'title_en' => 'Jubail']);
        Category::updateOrCreate(['id' => 5], ['id' => 5, 'title_ar' => 'مكة المكرمة', 'title_en' => 'Mecca']);
        Category::updateOrCreate(['id' => 6], ['id' => 6, 'title_ar' => 'المدينة المنورة', 'title_en' => 'Medina']);
        Category::updateOrCreate(['id' => 7], ['id' => 7, 'title_ar' => 'الدمام', 'title_en' => 'Dammam']);
        Category::updateOrCreate(['id' => 8], ['id' => 8, 'title_ar' => 'النادي السعودي للصحافة', 'title_en' => 'Saudi Press Club', 'status' => 0]);
        Category::updateOrCreate(['id' => 9], ['id' => 9, 'title_ar' => 'نادي جدة للصحافة', 'title_en' => 'Jeddah Press Club', 'status' => 0]);
        Category::updateOrCreate(['id' => 10], ['id' => 10, 'title_ar' => 'الرياض', 'title_en' => '']);
        Category::updateOrCreate(['id' => 11], ['id' => 11, 'title_ar' => 'القصيم', 'title_en' => '']);
        Category::updateOrCreate(['id' => 12], ['id' => 12, 'title_ar' => 'الباحة', 'title_en' => '']);
        Category::updateOrCreate(['id' => 13], ['id' => 13, 'title_ar' => 'الجوف', 'title_en' => '']);
        Category::updateOrCreate(['id' => 14], ['id' => 14, 'title_ar' => 'الحدود الشمالية', 'title_en' => '']);
        Category::updateOrCreate(['id' => 15], ['id' => 15, 'title_ar' => 'عسير', 'title_en' => '']);
        Category::updateOrCreate(['id' => 16], ['id' => 16, 'title_ar' => 'جازان', 'title_en' => '']);
        Category::updateOrCreate(['id' => 17], ['id' => 17, 'title_ar' => 'نجران', 'title_en' => '']);
        Category::updateOrCreate(['id' => 18], ['id' => 18, 'title_ar' => 'تبوك', 'title_en' => '']);
        Category::updateOrCreate(['id' => 19], ['id' => 19, 'title_ar' => 'الطائف', 'title_en' => '']);
        Category::updateOrCreate(['id' => 20], ['id' => 20, 'title_ar' => 'عام', 'title_en' => 'General', 'order' => 0]);
    }
}
