<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rate extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $with = [
        'User:id,user_name'
    ];

    protected $fillable = [
        'user_id',
        'rate',
        'description',
    ];

    protected $hidden = [
        'updated_at',
    ];

    protected $casts = [
        'rate' => 'integer',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
