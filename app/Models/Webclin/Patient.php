<?php

namespace App\Models\Webclin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'social_name',
        'mother_name',
        'email',
        'sus',
        'birthday',
        'rg',
        'cpf',
        'gender',
        'address',
        'city',
        'state',
        'zip',
        'complement',
        'neighborhood',
        'phone',
        'cellphone'
    ];

    /**
     * @return HasMany
     */
    public function medicalRecords(): HasMany
    {
        return $this->hasMany(MedicalRecord::class, 'patient_id', 'id');
    }
}
