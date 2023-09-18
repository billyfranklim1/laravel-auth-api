<?php

namespace App\Models\CORE;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\PersonalAccessTokenResult;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];


    /**
     * @return HasMany
     */
    public function userSystems(): HasMany
    {
        return $this->hasMany(UserSystems::class, 'user_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function userUnits(): HasMany
    {
        return $this->hasMany(UserUnit::class, 'user_id', 'id');
    }

    /**
     * @param array $systems
     * @return void
     */
    public function syncSystems(array $systems): void
    {
        $userId = $this->id;

        foreach ($systems as $systemId) {
            $this->userSystems()->firstOrCreate([
                'user_id' => $userId,
                'system_id' => $systemId
            ]);
        }
    }

    /**
     * @return array
     */
    public function getSystemNames(): array
    {
        $userSystems = $this->userSystems;

        $systemNames = [];
        foreach ($userSystems as $userSystem) {
            if ($userSystem->hasSystem) {
                $systemNames[$userSystem->system_id] = $userSystem->hasSystem->system;
            }
        }

        return $systemNames;
    }

    /**
     * @param array $units
     * @return void
     */
    public function syncUnits(array $units): void
    {
        $userId = $this->id;

        foreach ($units as $unitId) {
            $this->userUnits()->firstOrCreate([
                'user_id' => $userId,
                'unit_id' => $unitId
            ]);
        }
    }

    /**
     * @return array
     */
    public function getUnitNames(): array
    {
        $userUnits = $this->userUnits;

        $unitNames = [];
        foreach ($userUnits as $userUnit) {
            if ($userUnit->hasUnit) {
                $unitNames[$userUnit->unit_id] = $userUnit->hasUnit->unit;
            }
        }

        return $unitNames;
    }

    // verifySystemAccess
    /**
     * @param $systemId
     * @return bool
     */
    public function verifySystemAccess($systemId): bool
    {
        if ($this->hasRole('Super-Admin')) return true;

        $userSystems = $this->userSystems()->where('user_id', $this->id)->get();
        $userSystems = $userSystems->pluck('system_id')->toArray();
        if (in_array($systemId, $userSystems)) {
            return true;
        }
        return false;
    }
}
