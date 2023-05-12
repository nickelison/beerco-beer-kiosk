<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchAnalytics extends Model
{
    protected $table = 'searches';
    protected $primaryKey = 'SearchId';

    public static function logSearch(array $params) {
        $formFields = [
            'PrimaryStyle' => $params['style'] ?? null,
            'Abv' => $params['abv'] ?? null,
            'Ibu' => $params['ibu'] ?? null,
            'Srm' => $params['srm'] ?? null,
            'OriginRegion' => $params['or'] ?? null,
            'OriginCountry' => $params['oc'] ?? null,
            'Brewer' => $params['brewer'] ?? null,
            'Brand' => $params['brand'] ?? null,
            'FoodPairing' => $params['fp'] ?? null,
            'ResultPage' => $params['page'] ?? null
        ];

        SearchAnalytics::create($formFields);
    }
}
