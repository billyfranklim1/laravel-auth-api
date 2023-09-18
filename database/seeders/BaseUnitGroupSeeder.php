<?php

namespace Database\Seeders;

use App\Models\CORE\UnitGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaseUnitGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnitGroup::updateOrCreate(['group' => 'COMPANY']);
        UnitGroup::updateOrCreate(['group' => 'COMPANY 1']);
        UnitGroup::updateOrCreate(['group' => 'COMPANY 2']);
        UnitGroup::updateOrCreate(['group' => 'COMPANY 3']);
        UnitGroup::updateOrCreate(['group' => 'COMPANY 4']);
    }
}
