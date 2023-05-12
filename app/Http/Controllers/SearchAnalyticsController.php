<?php

namespace App\Http\Controllers;
use App\Models\SearchAnalytics;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchAnalyticsController extends Controller
{
    public function deleteAll() {
        // Truncate searches table
        SearchAnalytics::truncate();

        // Reset product view count
        Product::query()->update(['Views' => 0]);
        
        return redirect('/console/reports')->with('message', 'Search logs successfully deleted.');
    }
}
