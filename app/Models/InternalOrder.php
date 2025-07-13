<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternalOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';



    protected $fillable = [
        'invoice_id',
        'waiter_id',
        'full_price',
        'type',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = ['waiter_name','table_id','external_order_info'];

    /** @noinspection PhpUnused */
    public function getExternalOrderInfoAttribute()
    {
        if ($this->type !== 'ext') {
            return null;
        }

        return ExternalOrderInformation::where('invoice_id', $this->invoice_id)->first();
    }

    /** @noinspection PhpUnused */
    public function getWaiterNameAttribute()
    {
        $name = $this->Waiter?->name;
        unset($this->Waiter);
        return $name;
    }

    /** @noinspection PhpUnused */
    public function getTableIdAttribute()
    {
        $tableId = $this->Invoice?->table_id;
        unset($this->Invoice);
        return $tableId;
    }


    /** @noinspection PhpUnused */
    public function Waiter(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'waiter_id');
    }

    public function InternalOrderLines(): HasMany
    {
        return $this->hasMany(InternalOrderItem::class, 'internal_order_id');
    }

    /** @noinspection PhpUnused */
    public function InternalOrderOffers(): HasMany
    {
        return $this->hasMany(InternalOrderOffer::class, 'internal_order_id');
    }

    public function Invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
