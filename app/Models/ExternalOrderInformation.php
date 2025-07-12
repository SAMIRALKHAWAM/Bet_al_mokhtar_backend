<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExternalOrderInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'user_id',
        'location',
        'phone',
        'qr',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
