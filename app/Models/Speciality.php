<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Speciality extends Model
{
    use HasFactory;
    protected $fillable = [

        'Speciality',
        'department',
        'framework',
        'Language',

    ];

    public function Knowledge(): HasMany
    {
        return $this->hasMany(Knowledge::class, 'specilaty_id', );
    }
}
