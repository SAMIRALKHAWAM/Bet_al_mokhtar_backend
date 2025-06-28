<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory,SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'code',
        'percent',
        'from_date',
        'to_date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'percent' => 'integer',
    ];

    public function InvoiceDiscounts(): HasMany
    {
        return $this->hasMany(InvoiceDiscount::class, 'discount_id');
    }
}
