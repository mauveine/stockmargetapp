<?php

namespace Tests\Unit;

use App\Models\NasdaqListedCompany;
use App\Services\RapidAPI\RapidAPIHistorical;
use Tests\TestCase;
use Tests\CreatesApplication;

class RapidAPIServiceTest extends TestCase
{
    use CreatesApplication;
    protected RapidAPIHistorical $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new RapidAPIHistorical();
    }

    public function test_service_init () {
        $this->assertEquals((fn() => $this->host)->call($this->service), config('nasdaq.api_host'));
        $this->assertEquals((fn() => $this->key)->call($this->service), config('nasdaq.api_key'));
        $this->assertEquals((fn() => $this->url)->call($this->service), config('nasdaq.historical_api_url'));
    }

    public function test_api_accessible () {
        $result = $this->service->retrieveData('');
        $this->assertNotNull($result);
        $this->assertEquals(0, $result->count());
    }

    public function test_api_query_works () {
        $company = NasdaqListedCompany::query()->where('symbol', 'AMRN')->first();
        $this->assertNotNull($company);
        $result = $this->service->retrieveData($company->symbol);
        $this->assertTrue($result->count() > 0);
    }

    public function test_api_result_filtered () {
        $company = NasdaqListedCompany::query()->where('symbol', 'AMRN')->first();
        $this->assertNotNull($company);
        $result = $this->service->getDataBetweenDates($company->symbol, '-6 months', 'today');
        $this->assertTrue($result->count() > 0);
        $this->assertTrue(!is_numeric($result->get(0)['date']));
    }
}
