<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'study_semester',
        'current_year',
        'section',
        'study_sequence',

    ];

    public function User():HasOne
    {
        return $this->hasOne(User::class, 'sturdent_id',);
    }
}
