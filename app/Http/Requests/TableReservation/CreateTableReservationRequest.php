<?php

namespace App\Http\Requests\TableReservation;

use App\Http\Requests\BaseRequest;
use App\Rules\ReservationAvailable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CreateTableReservationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'table_id' => [Rule::exists('tables','id')->whereNull('deleted_at'),'required'],
            'date' => [
                'required',
                'date',
                'after:today',
            ],
            'from_time' => [
                'required',
                'date_format:H:i',
            ],
            'to_time' => [
                'required',
                'date_format:H:i',
                'after:from_time',
                new ReservationAvailable(
                    $this->table_id,
                    $this->date,
                    $this->from_time,
                    $this->to_time
                ),
            ],
        ];
    }


}
