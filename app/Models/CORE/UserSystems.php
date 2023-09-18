<?php

namespace App\Models\CORE;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class UserSystems extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'system_id'
    ];

    /**
     * @return HasOne
     */
    public function hasSystem(): HasOne
    {
        return $this->hasOne(System::class, 'id', 'system_id');
    }
}
