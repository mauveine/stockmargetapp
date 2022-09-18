<?php

namespace App\Http\Requests;

use App\Models\NasdaqListedCompany;
use Illuminate\Foundation\Http\FormRequest;

class StockSearchGet extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (!$this->anyFilled(['email', 'companySymbol', 'startDate', 'endDate'])) {
            return [];
        }
        $found = NasdaqListedCompany::search($this->input('companySymbol'))->get()->first();
        return [
            'email' => 'required|email',
            'companySymbol' => [
                'required',
                function ($attribute, $value, $fail) use ($found){
                    if (!$found) {
                        $fail('Symbol not found!');
                    }
                }
            ],
            'endDate' => [
                'required',
                'date',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) {
                    $passedTime = strtotime($value);
                    if ($passedTime > time()) {
                        $fail('End date needs to be less or equal to today');
                    }
                }
            ],
            'startDate' => [
                'required',
                'date',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) {
                    $startDate = strtotime($value);
                    $endDate = strtotime($this->input('endDate'));
                    if ($startDate > $endDate) {
                        $fail('Start date needs to be less or equal to end date');
                    }
                }
            ]
        ];
    }
}
