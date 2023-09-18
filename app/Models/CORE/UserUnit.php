<?php

namespace App\Models\CORE;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class UserUnit extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'unit_id'
    ];

    /**
     * @return HasOne
     */
    public function hasUnit(): HasOne
    {
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }
}
