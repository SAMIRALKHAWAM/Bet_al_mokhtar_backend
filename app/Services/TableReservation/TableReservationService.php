<?php

namespace App\Services\TableReservation;

use App\Models\Branch;
use App\Models\Table;
use App\Models\TableReservation;
use App\Rules\ReservationAvailable;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class TableReservationService extends BaseService
{
    public function __construct(TableReservation $model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        $rule = new ReservationAvailable(
            $data['branch_id'],
            $data['date'],
            $data['from_time'],
            $data['to_time'],
            $data['chairs']
        );

        $rule->validate('to_time',  $data['to_time'], function ($message) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                 $message,
            ]);
        });

        $tableId = $rule->getAvailableTableId();


        $reservation = DB::table('table_reservations')->insert([
            'table_id' => $tableId,
            'date' => $data['date'],
            'from_time' => $data['from_time'],
            'to_time' => $data['to_time'],
        ]);

    }
}
