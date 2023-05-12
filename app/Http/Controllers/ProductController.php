<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SearchAnalytics;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Show all products
    public function index() {
        $styles = DB::select(
            'SELECT DISTINCT PrimaryStyle 
             FROM beerco.products
             WHERE PrimaryStyle != ""
             ORDER BY PrimaryStyle ASC;');

        $originCountries = DB::select(
            'SELECT DISTINCT OriginCountry
             FROM beerco.products
             WHERE OriginCountry != ""
             ORDER BY OriginCountry ASC;'
        );

        $originRegions = DB::select(
            'SELECT DISTINCT OriginRegion
             FROM beerco.products
             WHERE OriginRegion != ""
             ORDER BY OriginRegion ASC;'
        );

        $brewers = DB::select(
            'SELECT DISTINCT Brewer 
             FROM beerco.products
             WHERE Brewer != ""
             ORDER BY Brewer ASC;');
        
        $sortOptions = [
            'Most Popular (default)',
            'Price (low)',
            'Price (high)',
            'Brand (A-Z)',
            'Brand (Z-A)',
            'Brewer (A-Z)',
            'Brewer (Z-A)'
        ];

        // Get search query parameters
        $queryParams = request(['style', 'abv', 'ibu', 'srm', 'vit', 'oc', 'or', 'brewer', 'brand', 'fp', 'stock', 'page', 'price', 'sort']);

        // Only log searches when NOT in admin mode
        if(auth()->id() == null) {
            SearchAnalytics::logSearch($queryParams);
        }
        
        // Build list for sort parameters [column name, sort direction]
        if($queryParams['sort'] ?? false) {
            if($queryParams['sort'] == 'Most Popular') {
                $sort = ['Views', 'desc'];
            } else if ($queryParams['sort'] == 'Price (low)') {
                $sort = ['Price', 'asc'];
            } else if ($queryParams['sort'] == 'Price (high)') {
                $sort = ['Price', 'desc'];
            } else if ($queryParams['sort'] == 'Brand (A-Z)') {
                $sort = ['Brand', 'asc'];
            } else if ($queryParams['sort'] == 'Brand (Z-A)') {
                $sort = ['Brand', 'desc'];
            } else if ($queryParams['sort'] == 'Brewer (A-Z)') {
                $sort = ['Brand', 'asc'];
            } else if ($queryParams['sort'] == 'Brewer (Z-A)') {
                $sort = ['Brewer', 'desc'];
            } else {
                $sort = ['ProductId', 'asc'];
            }
        } else {
            $sort = ['Views', 'desc'];
        }
                
        return view('products.index', [
            'products' => Product::orderBy($sort[0], $sort[1])->filter
            ($queryParams)->paginate(12),
            'styles' => $styles,
            'originCountries' => $originCountries,
            'originRegions' => $originRegions,
            'brewers' => $brewers,
            'sortOptions' => $sortOptions
        ]);
    }
    

    // Create product page
    public function create() {
        return view('products.create');
    }

    // Store product data (i.e., actually create listing)
    public function store(Request $req) {         
        $formFields = $req->validate([
            'upc' => '',
            'brand' => 'required',
            'brewer' => 'required',
            'originRegion' => 'required',
            'originCountry' => 'required',
            'originState' => '',
            'originLocal' => '',
            'tempStyle1' => '',
            'tempStyle2' => '',
            'primaryStyle' => 'required',
            'primaryStyleDesc' => '',
            'specificStyle' => 'required',
            'specificStyleDesc' => '',
            'foodPairing' => '',
            'oz' => 'required',
            'ml' => '',
            'container' => '',
            'packageType' => '',
            'abv' => 'required',
            'ibu' => 'required',
            'srm' => 'required',
            'malt' => '',
            'hops' => '',
            'calories' => '',
            'description' => '',
            'price' => 'required',
            'inStock' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|max:5000'
        ]);

        // Rename image
        $newImg = time() . '-' . Str::slug($req->brand) . '.' . $req->image->extension();
        
        // Move image to public/images
        $req->image->move(public_path('images'), $newImg);

        // Remove 'image' from $formFields
        array_pop($formFields);
    
        // Add 'ImgFile' with name of new image to $formFields
        $formFields += array('ImgFile' => $newImg);
        
        // Add product to database
        Product::create($formFields);

        // Get newly added product from database
        $product = Product::latest()->first();
        
        // Redirect to new product page
        return redirect('/products/' . $product->ProductId)->with('message', 'Product has been added!');
    }

    // Single product page
    public function show(Product $product) {
        $similarAbv = DB::select(
            'SELECT p.* 
             FROM beerco.products as p
             WHERE p.InStock = 1 AND p.Abv = ?
             ORDER BY RAND()
             LIMIT 10;', array($product->Abv));
        
        $similarIbu = DB::select(
            'SELECT p.* 
             FROM beerco.products as p
             WHERE p.InStock = 1 AND p.Ibu = ?
             ORDER BY RAND()
             LIMIT 10;', array($product->Ibu));

        $similarSrm = DB::select(
            'SELECT p.* 
             FROM beerco.products as p
             WHERE p.InStock = 1 AND p.Srm = ?
             ORDER BY RAND()
             LIMIT 10;', array($product->Srm));

        $sameBrewer = DB::select(
            'SELECT p.*
             FROM beerco.products as p
             WHERE p.InStock = 1 AND p.Brewer = ? AND p.ProductId != ?
             ORDER BY RAND()
             LIMIT 10;', array($product->Brewer, $product->ProductId));

        return view('products.product', [
            'product' => $product,
            'similarAbv' => $similarAbv,
            'similarIbu' => $similarIbu,
            'similarSrm' => $similarSrm,
            'sameBrewer' => $sameBrewer
        ]);
    }

    // Delete product
    public function destroy(Product $product) {
        $product->delete();
        return redirect('/')->with('message', 'Product deleted successfully.');
    }
    
    // Edit product page
    public function edit(Product $product) {
        return view('products.edit', ['product' => $product]);
    }

    // Update product
    public function update(Request $req, Product $product) {        
        // Note: request payload is in camelCase
        $formFields = $req->validate([
            'upc' => '',
            'brand' => 'required',
            'brewer' => 'required',
            'originRegion' => '',
            'originCountry' => '',
            'originState' => '',
            'originLocal' => '',
            'tempStyle1' => '',
            'tempStyle2' => '',
            'primaryStyle' => '',
            'primaryStyleDesc' => '',
            'specificStyle' => '',
            'specificStyleDesc' => '',
            'foodPairing' => '',
            'oz' => '',
            'ml' => '',
            'container' => '',
            'packageType' => '',
            'abv' => '',
            'ibu' => '',
            'srm' => '',
            'malt' => '',
            'hops' => '',
            'calories' => '',
            'description' => '',
            'inStock' => '',
            'price' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:5000'
        ]);

        if($req->image) {
            // Rename image
            $newImg = time() . '-' . Str::slug($req->brand) . '.' . $req->image->extension();
            
            // Move image to public/images
            $req->image->move(public_path('images'), $newImg);

            // Remove 'image' from $formFields
            array_pop($formFields);
        
            // Add 'ImgFile' with name of new image to $formFields
            $formFields += array('ImgFile' => $newImg);
        }
        
        $product->update($formFields);

        // Redirect to product page
        return redirect('/products/'.$product->ProductId)->with('message', 'Product has been updated!');
    }

    public function updateViewCount(Request $req) {
        // Only update view count if logged out
        if(auth()->id() == null) {
            $productId = $req->get('productId');
            $product = Product::find($productId);
            $currViews = $product->Views;
            $product->Views = $currViews + 1;
            $product->save();
        }
    }

    public function specials() {
        $prices = DB::select(
            'SELECT Price, COUNT(*) as count
             FROM beerco.products
             GROUP BY Price
             ORDER BY Price ASC;');
            
        $brewers = DB::select(
            'SELECT Brewer, AVG(Price) AvgPrice, Count(*) as count
             FROM beerco.products
             GROUP BY Brewer
             ORDER BY AvgPrice DESC;');

        return view('products.specials', [
            'prices' => $prices,
            'brewers' => $brewers
        ]);
    }
}
