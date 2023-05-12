@section('title', $product->Brand)
@section('csrf_token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

<x-layout>
  <section class="container col-md-10 product-page">

    <h1 class="pt-2 mb-0">{{ $product->Brand }}</h1>
    <h2>{{ $product->Brewer }}</h2>
    <h4>${{ $product->Price }}
      @if($product->Oz)
      | {{ $product->Oz }} oz.
        @if($product->Ml)
          ({{ $product->Ml }} ml)
        @endif

        @if($product->Container)
          {{ $product->Container }}
        @endif

        @if($product->PackageType)
          | 
          {{ $product->PackageType }}
        @endif 
      @endif
    </h4>

    <figure class="container col-md-12 p-0 m-0 mb-2">
      @if($product->ImgFile)
      <img src="{{ asset('images/' . $product->ImgFile) }}" class="img-fluid" alt="...">
      @else
      <img src="{{ asset('images/placeholder.jpg') }}" class="img-fluid" alt="...">      
      @endif
    </figure>
    
    @if($product->InStock == 1)
      <div class="alert alert-success">
        <span>Product is in stock.</span>
      </div>    
    @else
      <div class="alert alert-danger">
        <span>Product is out of stock.</span>
      </div>
    @endif

    <!-- PRODUCT INFORMATION -->
    <h3>Product Information</h3>

    @if($product->Description)
      <p>{{ $product->Description}}</p>
    @endif 
  
    <h5>Primary Style: {{ $product->PrimaryStyle }}</h5>
    <p>{{ $product->PrimaryStyleDesc }}</p>

    <h5>Specific Style: {{ $product->SpecificStyle }}</h5>
    <p>{{ $product->SpecificStyleDesc }}</p>

    <h5>Vitals</h5>
    <ul>
      @if($product->Abv != 0)
        <li>ABV: {{ $product->Abv }}</li>
      @else
        <li>ABV: ?</li>
      @endif

      @if($product->Ibu != 0)
        <li>IBU: {{ $product->Ibu }}</li>
      @else
        <li>IBU: ?</li>
      @endif

      @if($product->Srm != 0)
        <li>Srm: {{ $product->Srm }}</li>
      @else
        <li>Srm: ?</li>
      @endif
    </ul>

    <h5>Other Info</h5>
    <ul>
      @if($product->Malt)<li>Malt: {{ $product->Malt }}</li>@endif
      @if($product->Hops)<li>Hops: {{ $product->Hops }}</li>@endif
      @if($product->OriginRegion)<li>Origin Region: {{ $product->OriginRegion }}</li>@endif
      @if($product->OriginCountry)<li>Origin Country: {{ $product->OriginCountry }}</li>@endif
      @if($product->OriginState)<li>Origin State: {{ $product->OriginState }}</li>@endif
      @if($product->OriginLocal)<li>Origin Local: {{ $product->OriginLocal }}</li>@endif
      <li>Calories: {{ $product->Calories }}</li>
    </ul>

    @if($product->FoodPairing)
      @if($product->FoodPairing != 'None')
        <h5>Food Pairing Recommendations</h5>
        <p>{{ $product->FoodPairing }}</p>
      @endif
    @endif

    @auth
    <a href="/products/{{ $product->ProductId }}/edit" class="btn btn-secondary mb-2">Edit Product Info</a>
    @endauth
  </section>

  @if(count($sameBrewer) > 0)
  <section class="container similar-products col-md-10 mt-3">
    <h4 class="pt-2">Other Beers from {{ $product->Brewer }}</h4>
    <div class="container-fluid p-0 m-0">
      <div class="scroll-wrap row flex-row flex-nowrap pb-3 pt-1">
            @foreach($sameBrewer as $sb)
            <x-similar-product-card :p="$sb"/>
            @endforeach
        </div>
    </div>
  </section>
  @endif

  @if(count($similarAbv) > 0)
  <section class="container similar-products col-md-10 mt-3">
    <h4 class="pt-2">Beers with Same ABV</h4>
    <div class="container-fluid p-0 m-0">
        <div class="scroll-wrap row flex-row flex-nowrap pb-3 pt-1">
            @foreach($similarAbv as $sAbv)
            <x-similar-product-card :p="$sAbv"/>
            @endforeach
        </div>
    </div>
  </section>
  @endif

  @if(count($similarIbu) > 0)
  <section class="container similar-products col-md-10 mt-3">
    <h4 class="pt-2">Beers with Same IBU</h4>
    <div class="container-fluid p-0 m-0">
      <div class="scroll-wrap row flex-row flex-nowrap pb-3 pt-1">
            @foreach($similarIbu as $sIbu)
            <x-similar-product-card :p="$sIbu"/>
            @endforeach
        </div>
    </div>
  </section>
  @endif
  
  @if(count($similarSrm) > 0)
  <section class="container similar-products col-md-10 mt-3">
    <h4 class="pt-2">Beers with Same SRM</h4>
    <div class="container-fluid p-0 m-0">
      <div class="scroll-wrap row flex-row flex-nowrap pb-3 pt-1">
            @foreach($similarSrm as $sSrm)
            <x-similar-product-card :p="$sSrm"/>
            @endforeach
        </div>
    </div>
  </section>
  @endif

</x-layout>

<script type="text/javascript" src="{{ URL::asset('js/product.js') }}"></script>