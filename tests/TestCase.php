<?php

namespace Tests;

use App\Models\CORE\User;
use App\Models\CORE\System;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;

    protected User $agent;

    /**
     * @return void
     */
    protected function setUpSuperAdminAgent(): void
    {
        $this->agent = User::factory()->create();
        $this->agent->assignRole('Super-Admin');
    }

    protected function setUpSystems(): void
    {
        $systems = [
            'system1',
            'system2',
            'system3',
            'system4',
            'system5',
        ];

        foreach ($systems as $system) {
            System::updateOrCreate(['system' => $system]);
        }
    }
}
