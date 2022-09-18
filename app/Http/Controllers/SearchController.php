<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockSearchGet;
use App\Models\NasdaqListedCompany;
use App\Services\RapidAPI\RapidAPIHistorical;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function index(StockSearchGet $request) {
        $props = [
            'companies' => \App\Models\NasdaqListedCompany::all()->toArray(),
            'stockInfo' => []
        ];
        $validated = $request->validated();

        $all = $request->input();
        // If all inputs are successfully validated
        if(count($all) > 0 && count($request->all()) === count($validated)) {
            $stockInfo = (new RapidAPIHistorical)
                ->getDataBetweenDates(
                    $request->input('companySymbol'),
                    $request->input('startDate'),
                    $request->input('endDate')
                );
            $props['stockInfo'] = $stockInfo->all();
        }
        return Inertia::render('Dashboard', $props);
    }
}
