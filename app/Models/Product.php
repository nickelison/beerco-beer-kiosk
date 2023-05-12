<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags'];
    // not using fillable because using unguard() in AppServiceProvider.php
    
    protected $primaryKey = 'ProductId';

    public function scopeFilter($query, array $filters) {
        // Beer Style
        if($filters['style'] ?? false) {
            $style = request('style');
            if($style ?? 'Any') {
                $query->where('PrimaryStyle', '=', $style);
            }
        }

        // ABV
        if($filters['abv'] ?? false) {
            $query->where('Abv', '=', (float) request('abv'));
        }

        // IBU
        if($filters['ibu'] ?? false) {
            $query->where('Ibu', '=', request('ibu'));
        }

        // SRM
        if($filters['srm'] ?? false) {
            $query->where('Srm', '=', request('srm'));
        }

        // Must have vital stats
        if($filters['vit'] ?? false && $filters['vit'] == 'y') {
            $query->where('Abv', '!=', 0);
            $query->where('Ibu', '!=', 0);
            $query->where('Srm', '!=', 0);
        }

        // Origin Country
        if($filters['oc'] ?? false) {
            $query->where('OriginCountry', '=', request('oc'));
        }

        // Origin Region
        if($filters['or'] ?? false) {
            $query->where('OriginRegion', '=', request('or'));
        }

        // Brewer
        if($filters['brewer'] ?? false) {
            // https://stackoverflow.com/questions/46238718/laravelhow-to-use-lowercase-function-in-eloquent-query
            $query->whereRaw('LOWER(`Brewer`) LIKE ?', ['%'.trim(strtolower(request('brewer'))).'%']);
        }

        // Brand
        if($filters['brand'] ?? false) {
            // https://stackoverflow.com/questions/46238718/laravelhow-to-use-lowercase-function-in-eloquent-query
            $query->whereRaw('LOWER(`Brand`) LIKE ?', ['%'.trim(strtolower(request('brand'))).'%']);
        }

        // Food Pairing
        if($filters['fp'] ?? false) {
            // https://stackoverflow.com/questions/46238718/laravelhow-to-use-lowercase-function-in-eloquent-query
            $query->whereRaw('LOWER(`FoodPairing`) LIKE ?', ['%'.trim(strtolower(request('fp'))).'%']);
        }

        // In-stock only
        if($filters['stock'] ?? false) {
            $query->where('InStock', '=', 1);
        }

        // Price
        if($filters['price'] ?? false) {
            $query->where('Price', '=', request('price'));
        }
    }
}
