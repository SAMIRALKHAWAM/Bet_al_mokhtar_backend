<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'sub_admin_id',
        'name',
        'location',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /** @noinspection PhpUnused */
    public function Employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'branch_id');
    }

    public function Tables(): HasMany
    {
        return $this->hasMany(Table::class, 'branch_id');
    }

    public function Invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'branch_id');
    }


    public function OfferBranches(): HasMany
    {
        return $this->hasMany(OfferBranch::class, 'branch_id');
    }

    public function Rates(): HasMany
    {
        return $this->hasMany(Rate::class, 'branch_id');
    }

    public function Warehouse(): HasOne
    {
        return $this->hasOne(Warehouse::class, 'branch_id');
    }

    public function SubAdmin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'sub_admin_id')->withTrashed();
    }

}
