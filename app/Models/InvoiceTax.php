<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceTax extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'invoice_id',
        'tax_id',
        'percent',
        'amount',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'percent' => 'integer',
        'amount' => 'integer',
    ];

    protected $appends = ['tax_name'];


    public function getTaxNameAttribute()
    {
        $name = $this->Tax->name;
        unset($this->Tax);
        return $name;
    }

    public function Invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function Tax(): BelongsTo
    {
        return $this->belongsTo(Tax::class, 'tax_id')->withTrashed();
    }
}
