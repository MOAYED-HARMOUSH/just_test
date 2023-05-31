<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Follow_Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'page_id',

    ];
    public function User():BelongsTo
    {
        return $this->belongsTo(User::class,  'user_id');
    }
    public function Page():BelongsTo
    {
        return $this->belongsTo(Page::class,  'page_id');
    }
}
