<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SearchAnalytics;
use Illuminate\Support\Facades\DB;

class MgmtConsoleController extends Controller
{
    public function index() {
        return view('console.index');
    }

    public function reports() {
        $brewerSearches = DB::select(
            'SELECT Brewer, COUNT(Brewer) AS Count
             FROM beerco.searches
             WHERE Brewer IS NOT NULL
             GROUP BY Brewer
             ORDER BY Count DESC
             LIMIT 10;');

        $brandSearches = DB::select(
            'SELECT Brand, COUNT(Brand) AS Count
             FROM beerco.searches
             WHERE Brand IS NOT NULL
             GROUP BY Brand
             ORDER BY Count DESC
             LIMIT 10;');
        
        $allSearches = DB::select(
            'SELECT * 
             FROM beerco.searches
             WHERE PrimaryStyle IS NOT NULL
                OR Abv IS NOT NULL
                OR Ibu IS NOT NULL
                OR Srm IS NOT NULL
                OR OriginRegion IS NOT NULL
                OR OriginCountry IS NOT NULL
                OR Brewer IS NOT NULL
                OR Brand IS NOT NULL
                OR FoodPairing IS NOT NULL
             ORDER BY created_at DESC;');

        $mostViewed = DB::select(
            'SELECT ProductId, Brand, Brewer, Views
             FROM beerco.products
             WHERE Views > 0
             ORDER BY Views DESC
             LIMIT 25;');
        
        return view('console.reports', [
            'allSearches' => $allSearches,
            'brewerSearches' => $brewerSearches,
            'brandSearches' => $brandSearches,
            'mostViewed' => $mostViewed
        ]);
    }
}
