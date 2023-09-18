<?php

namespace App\Models\CORE;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'unit',
        'unit_group_id',
        'unit_type_id',
        'address',
        'city',
        'state',
        'zip',
        'complement',
        'neighborhood',
        'phone',
        'cnes',
        'cnpj',
        'opening_hours',
        'has_psc'
    ];

    /**
     * @return HasOne
     */
    public function unitType(): HasOne
    {
        return $this->hasOne(UnitType::class, 'id', 'unit_type_id');
    }
}
