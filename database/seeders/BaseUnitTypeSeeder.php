<?php

namespace Database\Seeders;

use App\Models\CORE\UnitType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaseUnitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnitType::updateOrCreate(['description' => 'UPA']);
        UnitType::updateOrCreate(['description' => 'Agência Transfusional']);
        UnitType::updateOrCreate(['description' => 'Gerência SEDE']);
        UnitType::updateOrCreate(['description' => 'Diretoria SEDE']);
        UnitType::updateOrCreate(['description' => 'Corporação']);
        UnitType::updateOrCreate(['description' => 'Hospital']);
        UnitType::updateOrCreate(['description' => 'Casa de apoio']);
        UnitType::updateOrCreate(['description' => 'Hemocentro']);
        UnitType::updateOrCreate(['description' => 'Policlínica']);
        UnitType::updateOrCreate(['description' => 'Secretaria']);
        UnitType::updateOrCreate(['description' => 'Centro de Testagem']);
        UnitType::updateOrCreate(['description' => 'Maternidade']);
        UnitType::updateOrCreate(['description' => 'Clínica']);
        UnitType::updateOrCreate(['description' => 'Unidade de Cuidados Intensivos']);
        UnitType::updateOrCreate(['description' => 'Centro de Especialidades']);
    }
}
