<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'item_id',
        'image',
    ];

    protected $hidden = [
        'item_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function Item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
