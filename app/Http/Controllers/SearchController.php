<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockSearchGet;
use App\Mail\StockSearchRequested;
use App\Models\NasdaqListedCompany;
use App\Services\RapidAPI\RapidAPIHistorical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function index(StockSearchGet $request) {
        $props = [
            'companies' => \App\Models\NasdaqListedCompany::all()->toArray(),
            'stockInfo' => [],
            'filters' => [
                'startDate' => date('Y-m-d'),
                'endDate' => date('Y-m-d')
            ]
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
                )->sortBy('date');
            $props['stockInfo'] = $stockInfo->values()->all();
            $props['filters'] = $request->all();
            Mail::to($request->input('email'))
                ->send(new StockSearchRequested(
                    NasdaqListedCompany::search($request->input('companySymbol'))->first(),
                    $request->input('startDate'),
                    $request->input('endDate'))
                );
        }
        return Inertia::render('Dashboard', $props);
    }
}
