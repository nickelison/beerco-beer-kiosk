@section('title', 'Find a Beer')
<x-layout>
  <div class="container" id="product-search-container">
    <form action="/">
      <!-- BEER STYLE -->
      <label class="form-control-label" for="style">Beer Style</label>
      <select name="style" class="form-select">
        <option value="">Any Style (default)</option>
        @foreach($styles as $item)
          @if($item->PrimaryStyle == request()->query('style'))
            <option value="{{ $item->PrimaryStyle }}" selected="selected">
              {{ $item->PrimaryStyle }}
            </option>
          @else
            <option value="{{ $item->PrimaryStyle }}">
              {{ $item->PrimaryStyle }}
            </option>
          @endif
        @endforeach
      </select>

      <!-- ABV, IBU, SRM AND VITAL STATS -->
      <fieldset class="form-group mb-3 mt-2">
        <div class="row">
          <!-- ABV -->
          <div class="col-md-3">
            <label class="form-control-label" for="abv">ABV</label>
            <input name="abv" class="form-control" placeholder="ABV" type="number" step="0.1" value="{{ request()->query('abv') }}">
          </div>

          <!-- IBU -->
          <div class="col-md-3">
            <label class="form-control-label" for="ibu">IBU</label>
            <input name="ibu" class="form-control" placeholder="IBU" type="number" step="0.1" value="{{ request()->query('ibu') }}">
          </div>
          
          <!-- SRM -->
          <div class="col-md-3">
            <label class="form-control-label" for="srm">SRM</label>
            <input name="srm" class="form-control" placeholder="SRM" type="number" step="0.1" value="{{ request()->query('srm') }}">
          </div>

          <!-- MUST HAVE VITAL STATS -->
          <div class="col-md-3 d-flex align-items-center">
            <div class="mt-4">
              @if(request()->query('vit'))
                <input class="form-check-input" id="has_vit" name="vit" type="checkbox" value="y" checked>
              @else
                <input class="form-check-input" id="has_vit" name="vit" type="checkbox" value="y">
              @endif
              <label class="form-control-label ps-1" for="has_vit">Must have vital stats</label>
            </div>
          </div>
        </div>
      </fieldset>
      <div class="form-group mb-2">
        <a onclick="toggleAdvancedSearch()" id="advanced-search-toggle" class="pb-2">Advanced Search</a>
      </div>

      <div id="advanced-search">
        <!-- COUNTRY AND REGION OF ORIGIN -->
        <fieldset class="form-group mb-3 mt-2">
          <div class="row">
            <!-- REGION OF ORIGIN -->
            <div class="col-md-6">
              <label class="form-control-label" for="or">Origin Region</label>
              <select name="or" class="form-select">
                <option value="">Any (default)</option>
                @foreach($originRegions as $item)
                  @if($item->OriginRegion == request()->query('or'))
                    <option value="{{ $item->OriginRegion }}" selected="selected">{{ $item->OriginRegion }}</option>
                  @else
                    <option value="{{ $item->OriginRegion }}">{{ $item->OriginRegion }}</option>
                  @endif
                @endforeach
              </select>
            </div>

            <!-- COUNTRY OF ORIGIN -->
            <div class="col-md-6">
              <label class="form-control-label" for="oc">Origin Country</label>
              <select name="oc" class="form-select">
                <option value="">Any (default)</option>
                @foreach($originCountries as $item)
                  @if($item->OriginCountry == request()->query('oc'))
                    <option value="{{ $item->OriginCountry }}" selected="selected">{{ $item->OriginCountry }}</option>
                  @else
                    <option value="{{ $item->OriginCountry }}">{{ $item->OriginCountry }}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>
        </fieldset>

        <!-- BREWER -->
        <fieldset class="form-group mb-2 mt-2">
          <label class="form-control-label" for="brewer">Brewer</label>
          <input list="brewer-list" name="brewer" class="form-control" placeholder="Brewer" maxlength="60" value="{{ request()->query('brewer') }}">

          <datalist id="brewer-list">
            @foreach($brewers as $item)
              <option value="{{ $item->Brewer }}">
            @endforeach
          </datalist>
        </fieldset>

        <!-- BRAND -->
        <fieldset class="form-group mb-2 mt-1">
          <label class="form-control-label" for="brand">Brand</label>
          <input type="text" name="brand" class="form-control" placeholder="Brand" maxlength="60" value="{{ request()->query('brand') }}">
        </fieldset>

        <!-- FOOD PAIRINGS -->
        <fieldset class="form-group mb-3 mt-1">
          <label class="form-control-label" for="fp">Food Pairing</label>
          <input type="text" name="fp" class="form-control" placeholder="Food Pairing" maxlength="60" value="{{ request()->query('fp') }}">
        </fieldset>

        <!-- IN-STOCK ONLY -->
        <fieldset class="form-group mb-3 mt-2">
          <div class="form-check form-check-inline">
            @if(request()->query('stock'))
              <input class="form-check-input" id="in_stock" name="stock" type="checkbox" value="y" checked>
            @else
              <input class="form-check-input" id="in_stock" name="stock" type="checkbox" value="y">
            @endif
            <label class="form-control-label p-0" for="in_stock">In Stock Only</label>
          </div>
        </fieldset>

        <!-- SORT BY -->
        <fieldset class="form-group mb-3 mt-0">
          <label class="form-control-label" for="sort">Sort By</label>
          <select name="sort" class="form-select">
            @foreach($sortOptions as $option)
              @if($option == request()->query('sort'))
                <option value="{{ $option }}" selected="selected">{{ $option }}</option>
              @else
                <option value="{{ $option }}">{{ $option }}</option>
              @endif
            @endforeach
          </select>
        </fieldset>
      </div>

      
      <!-- SUBMIT BUTTON -->        
      <div class="d-flex">
        <button type="submit" class="btn btn-primary flex-grow-1">Find Beer</button>
      </div>
    </form>
  </div>

  <!--<div class="col-md-12 mx-auto">-->
  <div class="container beerco-sr-container">
    <!-- SEARCH RESULTS COUNT -->
    @if($products->total() == 1)
      <h3>{{ $products->total() }} Result</h3>
    @else
      <h3>{{ $products->total() }} Results</h3>
    @endif

    <div class="row">
      @foreach($products as $p)
      <div class="col item-c">
        <div class="item card">
          <figure class="item-img-c">
            @if($p->ImgFile)
            <img src="{{ asset('images/' . $p->ImgFile) }}" class="img-fluid" alt="...">
            @else
            <img src="{{ asset('images/placeholder.jpg') }}" class="item-img" alt="...">
            @endif
          </figure>
          <div class="item-title-c">
            <div class="item-branding">
              <span class="item-title">
                <a href="/products/{{ $p->ProductId }}" class="stretched-link">{{ $p->Brand }}</a>
              </span>
            
              <span class="item-brewer">{{ $p->Brewer }}</span>
            </div>

            <ul class="item-vitals">
              @if($p->Abv != 0)
                <li>ABV: <b>{{ $p->Abv }}</b></li>
              @else
                <li>ABV: ?</li>
              @endif

              @if($p->Ibu != 0)
                <li>IBU: <b>{{ $p->Ibu }}</b></li>
              @else
                <li>IBU: ?</li>
              @endif

              @if($p->Srm != 0)
              <li>SRM: <b>{{ $p->Srm }}</b></li>
              @else
              <li>SRM: ?</li>
              @endif
            </ul>

            <ul class="item-info">
              <li>Style: {{ $p->PrimaryStyle }}</li>
              <li>Region: {{ $p->OriginRegion }}</li>
              <li>Country: {{ $p->OriginCountry }}</li>
              @if($p->Oz != 0 || $p->Ml != 0)
              <li>Size:
                @if($p->Oz != 0)
                <span class="p-card-size-oz">{{ $p->Oz }} oz</span>
                @endif

                @if($p->Ml != 0)
                <span class="p-card-size-ml">({{ $p->Ml }} ml)</span>
                @endif
              </li>
              @endif
            </ul>

            <span class="p-card-price"><b>${{ $p->Price }}</b></span>
            
            @if($p->InStock)
              <span class="alert alert-success p-1">In Stock</span>  
            @else
              <span class="alert alert-danger p-1">Out of Stock</span>  
            @endif
          </div>
        </div> <!-- end item card -->
      </div> <!-- end col -->
      @endforeach
    </div> <!-- end row -->

    <div class="mt-3 pull-left">
      {{ $products->appends([
          'style'=>request()->query('style'),
          'abv'=>request()->query('abv'),
          'ibu'=>request()->query('ibu'),
          'srm'=>request()->query('srm'),
          'vit'=>request()->query('vit'),
          'oc'=>request()->query('oc'),
          'or'=>request()->query('or'),
          'brewer'=>request()->query('brewer'),
          'brand'=>request()->query('brand'),
          'fp'=>request()->query('fp'),
          'stock'=>request()->query('stock'),
          'price'=>request()->query('price'),
          'sort'=>request()->query('sort')
          ])->onEachSide(1)->links() }}
      </div>
  </div>
  <!-- </div> -->
  
</x-layout>

<script type="text/javascript" src="{{ URL::asset('js/search.js') }}"></script>