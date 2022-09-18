<?php

namespace Tests\Feature;

use App\Models\NasdaqListedCompany;
use App\Models\User;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class SearchControllerTest extends TestCase
{
    public function test_clean_dashboard () {
        $user = User::query()->first();
        $allCompaniesCount = NasdaqListedCompany::query()->count();
        $this->actingAs($user)->get('/dashboard')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Dashboard')
                ->has('companies', $allCompaniesCount, fn(Assert $page) => $page
                    ->hasAny(['company_name', 'symbol', 'financial_status', 'market_category', 'round_lot_size', 'security_name', 'test_issue'])
                    ->where('symbol', 'AAIT')
                )
            );
    }

    public function test_fail_simple_query () {
        $user = User::query()->first();
        $this->actingAs($user)->get('/dashboard?email=fgggg.com&startDate=2022-09-21&endDate=2022-09-19&companySymbol=AAAA')
            ->assertInvalid(['email', 'endDate', 'startDate', 'companySymbol']);
    }

    public function test_simple_query () {
        $user = User::query()->first();
        $this->actingAs($user)->get('/dashboard?email=fgg@gg.com&startDate=2022-08-05&endDate=2022-09-18&companySymbol=FCBC')
            ->assertInertia(fn (Assert $page) => $page
                ->has('filters', 4)
                ->where('filters.email', 'fgg@gg.com')
                ->where('filters.startDate', '2022-08-05')
                ->where('filters.endDate', '2022-09-18')
                ->where('filters.companySymbol', 'FCBC')
                ->has('stockInfo.0', fn(Assert $page) => $page
                    ->hasAny(['date', 'open', 'close', 'high', 'low', 'volume', 'adjclose'])
                )
            );
    }
}
