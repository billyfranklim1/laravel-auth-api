<?php

namespace App\Traits;

use Laravel\Sanctum\HasApiTokens as SanctumHasApiTokens;

trait HasCustomApiTokens
{
    use SanctumHasApiTokens {
        createToken as sanctumCreateToken;
    }

    public function createToken(string $name, array $abilities = ['*'])
    {
        $token = $this->sanctumCreateToken($name, $abilities);
        // SQL Server datetime format
        $token->created_at = now()->format('Y-m-d H:i:s');

        $token->save();

        return $token;
    }
    }
