<?php

namespace App\Services\RapidAPI;

class RapidAPIHistorical extends RapidAPIClient
{
    public function __construct()
    {
        $this->url = config('nasdaq.historical_api_url');
        parent::__construct();
    }

    public function getDataBetweenDates($companySymbol, $startDate, $endDate) {
        $allValues = $this->retrieveData($companySymbol);
        $startDateTime = strtotime($startDate);
        $endDateTime = strtotime($endDate);
        $allValues = $allValues->filter(function ($item) use ($startDateTime, $endDateTime) {
            return $item['date'] >= $startDateTime && $item['date'] <= $endDateTime;
        });
        return $allValues->transform(function ($item) {
            $item['date'] = date('Y-m-d', $item['date']);
            return $item;
        });
    }
}
