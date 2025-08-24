<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class ReservationAvailable implements ValidationRule
{

    protected $branchId;
    protected $date;
    protected $from;
    protected $to;
    protected $chairs;
    protected $availableTableId = null;

    public function __construct($branchId, $date, $from, $to, $chairs)
    {
        $this->branchId = $branchId;
        $this->date = $date;
        $this->from = $from;
        $this->to = $to;
        $this->chairs = $chairs;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $tables = DB::table('tables')
            ->where('branch_id', $this->branchId)
            ->where('chair_number', '>=', $this->chairs)
            ->whereNull('deleted_at')
            ->get();

        foreach ($tables as $table) {
            $conflict = DB::table('table_reservations')
                ->where('table_id', $table->id)
                ->where('date', $this->date)
                ->whereNull('deleted_at')
                ->where(function ($query) {
                    $query->whereBetween('from_time', [$this->from, $this->to])
                        ->orWhereBetween('to_time', [$this->from, $this->to])
                        ->orWhere(function ($q) {
                            $q->where('from_time', '<', $this->from)
                                ->where('to_time', '>', $this->to);
                        });
                })
                ->exists();

            if (! $conflict) {

                $this->availableTableId = $table->id;
                return;
            }
        }

        $fail("No available table in this branch matches the requirements.");
    }


    public function getAvailableTableId()
    {
        return $this->availableTableId;
    }
}
