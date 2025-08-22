<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TableReservation extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'table_id',
        'date',
        'from_time',
        'to_time',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function Table(): BelongsTo
    {
        return $this->belongsTo(Table::class, 'table_id');
    }
}
