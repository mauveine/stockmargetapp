<?php

namespace Database\Seeders;

use App\Models\NasdaqListedCompany;
use Illuminate\Database\Seeder;

class NasdaqListedCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($url = config('nasdaq.url')) {
            $companiesJson = file_get_contents($url);
            // Transform the json into a collection for parsing
            $companies = collect(json_decode($companiesJson, true));
            $companies->each(function ($item) {
                // With each item, transform it into a NasdaqListedCompany model
                // and save it into the database
                (new NasdaqListedCompany())->hydrateFromSpecial($item)->saveQuietly();
            });
        }
    }
}
