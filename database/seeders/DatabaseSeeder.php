<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\NewsSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\BranchSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\MemberSeeder;
use Database\Seeders\InvoiceSeeder;
use Database\Seeders\TechnicalSupportSeeder;
use Database\Seeders\RoleAndPermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleAndPermissionSeeder::class);
        // $this->call(BranchSeeder::class);
        // $this->call(AdminSeeder::class);
        // $this->call(MemberSeeder::class);
        // $this->call(InvoiceSeeder::class);
        // $this->call(TechnicalSupportSeeder::class);
        // $this->call(CourseSeeder::class);
        // $this->call(NewsSeeder::class);
        // $this->call(SiteOptionSeeder::class);
    }
}
