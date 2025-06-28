<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternalOrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'internal_order_lines';

    protected $primaryKey = 'id';

    protected $fillable = [
        'internal_order_id',
        'item_id',
        'quantity',
        'price',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = ['item_name','item_price'];

    /** @noinspection PhpUnused */
    public function getItemNameAttribute()
    {
        $name = $this->Item->name;
        unset($this->Item);
        return $name;
    }

    /** @noinspection PhpUnused */
    public function getItemPriceAttribute()
    {
        $price = $this->Item->price;
        unset($this->Item);
        return $price;
    }

    public function InternalOrder(): BelongsTo
    {
        return $this->belongsTo(InternalOrder::class, 'internal_order_id');
    }

    public function Item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id')->withTrashed();
    }
}
