<?php

namespace App\Services\Payroll;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

class PayrollService
{
    public function calculateFromUploadedFile($file): array
    {

        /** @var Collection $rows */
        $rows = Excel::toCollection(null, $file)->first() ?? collect();


        if ($rows->count() > 0) {
            $first = $rows->first();
            if ($first && isset($first[0]) && is_string($first[0]) && mb_strtolower(trim($first[0])) === 'name') {
                $rows = $rows->slice(1)->values();
            }
        }

        $results = [];


        foreach ($rows as $row) {
            $name        = $row['name']        ?? $row[0] ?? null;
            $hourlyRate  = $row['hourly_rate'] ?? $row[1] ?? null;
            $deduction   = $row['deduction']   ?? $row[2] ?? 0;

            $mon = (float) ($row['mon'] ?? $row[3] ?? 0);
            $tue = (float) ($row['tue'] ?? $row[4] ?? 0);
            $wed = (float) ($row['wed'] ?? $row[5] ?? 0);
            $thu = (float) ($row['thu'] ?? $row[6] ?? 0);
            $fri = (float) ($row['fri'] ?? $row[7] ?? 0);
            $sat = (float) ($row['sat'] ?? $row[8] ?? 0);
            $sun = (float) ($row['sun'] ?? $row[9] ?? 0);

            if ($name === null || $hourlyRate === null) {
                continue;
            }

            $hourlyRate = (float) $hourlyRate;
            $deduction  = (float) $deduction;

            $hours = compact('mon','tue','wed','thu','fri','sat','sun');

            $totalHours = array_sum($hours);
            $gross      = $totalHours * $hourlyRate;
            $net        = max(0, $gross - $deduction);

            $results[] = [
                'name'         => (string) $name,
                'hourly_rate'  => $hourlyRate,
                'deduction'    => $deduction,
                'total_hours'  => round($totalHours, 2),
                'total'        => round($gross, 2),
                'net'          => round($net, 2),
            ];

        }

        return $results;
    }
}

