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
        return $allValues->filter(function ($item) use ($startDateTime, $endDateTime) {
            return $item['date'] >= $startDateTime && $item['date'] <= $endDateTime;
        });
    }
}
