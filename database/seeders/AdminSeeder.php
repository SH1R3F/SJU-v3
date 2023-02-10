<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::factory()->create([
            'fname' => 'مدير',
            'lname' => 'النظام',
            'username' => 'admin',
            'email' => 'admin@sju.org.sa',
            'mobile' => '1234',
            'password' => bcrypt('Y#34603460m')
        ]);
        $admin->assignRole('Site admin');
        // Admin::factory(10)->create();
    }
}
