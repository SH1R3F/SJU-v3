<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TechnicalSupportTicket;
use App\Models\TechnicalSupportMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TechnicalSupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TechnicalSupportTicket::factory(30)->create();
        TechnicalSupportMessage::factory(300)->create();
    }
}
