<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $primaryKey = 'id';

    protected $appends = [
        'branch_name',
    ];

    protected $fillable = [
        'branch_id',
        'name',
        'user_name',
        'password',
        'type',
        'phone',
        'address',
        'age',
        'skill',
        'last_job',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'password' => 'hashed',
        'age' => 'integer'
    ];

    /** @noinspection PhpUnused */
    public function getBranchNameAttribute()
    {
        $branchName = $this->Branch?->name;
        unset($this->Branch);
        return $branchName;
    }

    public function Branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function InternalOrders(): HasMany
    {
        return $this->hasMany(InternalOrder::class, 'waiter_id');
    }
}
