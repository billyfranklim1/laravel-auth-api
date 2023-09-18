<?php

namespace Database\Seeders;

use App\Models\CORE\System;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaseSystemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        System::updateOrCreate(['system' => 'core']);
        System::updateOrCreate(['system' => 'gpc']);
        System::updateOrCreate(['system' => 'gmed']);
        System::updateOrCreate(['system' => 'webclin']);
    }
}
