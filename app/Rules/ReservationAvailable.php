<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class ReservationAvailable implements ValidationRule
{

    protected $tableId;
    protected $date;
    protected $from;
    protected $to;


    public function __construct($tableId, $date, $from, $to)
    {
        $this->tableId = $tableId;
        $this->date = $date;
        $this->from = $from;
        $this->to = $to;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $conflict = DB::table('table_reservations')
            ->where('table_id', $this->tableId)
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

        if ($conflict) {
            $fail("This table is already reserved in this time range.");
        }
    }
}
