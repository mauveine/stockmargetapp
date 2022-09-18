<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasdaqListedCompany extends Model
{
    use HasFactory;

    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];

    protected $fillable = [
        'company_name',
        'symbol',
        'financial_status',
        'market_category',
        'round_lot_size',
        'security_name',
        'test_issue'
    ];

    /**
     * Hydrate the model transforming json words into attributes
     * @param $attributes
     * @return $this
     */
    public function hydrateFromSpecial($attributes) : NasdaqListedCompany {
        foreach ($attributes as $key => $value) {
            // Transform all uppercase to lower and replace space with underscore
            // e.g. Company Name => company_name
            $convertedKey = str_replace(' ', '_', (strtolower($key)));
            // fill the model's properties dynamically
            $this->{$convertedKey} = $value;
        }
        return $this;
    }
}
