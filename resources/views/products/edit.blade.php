@section('title', 'Edit Product Information')
<x-layout>
  <div class="col-md-8 mx-auto">
    <section class="edit-product-form">
      <form method="POST" action="/products/{{ $product->ProductId }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <legend class="border-bottom mb-3">Update Product Info</legend>

        <fieldset class="form-group">
          <label class="form-control-label" for="productId">Product ID</label>
          <input class="form-control" type="text" name="productId" value="{{ $product->ProductId }}" disabled="disabled"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="upc">UPC</label>
          <input class="form-control" type="number" name="upc" value="{{ $product->Upc }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="brand">Brand Name</label>
          <input class="form-control" type="text" name="brand" value="{{ $product->Brand }}"/>
        
          @error('brand')
          <p class="alert alert-danger mt-2">{{ $message }}</p>
          @enderror
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="brewer">Brewer</label>
          <input class="form-control" type="text" name="brewer" value="{{ $product->Brewer }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="image">Product Image</label>
          <input class="form-control" type="file" name="image"/>

          @error('image')
          <p class="alert alert-danger mt-2">{{ $message }}</p>
          @enderror
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="originRegion">Origin Region</label>
          <input class="form-control" type="text" name="originRegion" value="{{ $product->OriginRegion }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="originCountry">Origin Country</label>
          <input class="form-control" type="text" name="originCountry" value="{{ $product->OriginCountry }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="originState">Origin State</label>
          <input class="form-control" type="text" name="originState" value="{{ $product->OriginState }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="originLocal">Origin Local</label>
          <input class="form-control" type="text" name="originLocal" value="{{ $product->OriginLocal }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="tempStyle1">Temp Style 1</label>
          <input class="form-control" type="text" name="tempStyle1" value="{{ $product->TempStyle1 }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="tempStyle2">Temp Style 2</label>
          <input class="form-control" type="text" name="tempStyle2" value="{{ $product->TempStyle2 }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="primarySyle">Primary Beer Style</label>
          <input class="form-control" type="text" name="primarySyle" value="{{ $product->PrimaryStyle }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="primaryStyleDesc">Primary Beer Style Desc</label>
          <textarea class="form-control" type="text" name="primaryStyleDesc" placeholder="...">{{ $product->PrimaryStyleDesc }}</textarea>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="specificStyle">Specific Beer Style</label>
          <input class="form-control" type="text" name="specificStyle" value="{{ $product->SpecificStyle }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="specificStyleDesc">Specific Beer Style Desc</label>
          <textarea class="form-control" type="text" name="specificStyleDesc" placeholder="...">{{ $product->SpecificStyleDesc }}</textarea>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="foodPairing">Food Pairing</label>
          <input class="form-control" type="text" name="foodPairing" value="{{ $product->FoodPairing }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="oz">Size (oz)</label>
          <input class="form-control" type="number" step=".1" name="oz" value="{{ $product->Oz }}"/>
        </fieldset>
        
        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="ml">Size (ml)</label>
          <input class="form-control" type="number" name="ml" value="{{ $product->Ml }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="container">Container</label>
          <input class="form-control" type="text" name="container" value="{{ $product->Container }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="packageType">Package Type</label>
          <input class="form-control" type="text" name="packageType" value="{{ $product->PackageType }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="abv">ABV</label>
          <input class="form-control" type="number" step=".1" name="abv" value="{{ $product->Abv }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="ibu">IBU</label>
          <input class="form-control" type="number" step=".1" name="ibu" value="{{ $product->Ibu }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="srm">SRM</label>
          <input class="form-control" type="number" step=".1" name="srm" value="{{ $product->Srm }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="malt">Malt</label>
          <input class="form-control" type="text" name="malt" value="{{ $product->Malt }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="hops">Hops</label>
          <input class="form-control" type="text" name="hops" value="{{ $product->Hops }}"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="calories">Calories</label>
          <input class="form-control" type="number" name="calories" value="{{ $product->Calories }}"/>
        </fieldset>
        
        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="description">Description</label>
          <textarea class="form-control" type="text" name="description" placeholder="">{{ $product->Description }}</textarea>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="price">Price</label>            
          <input class="form-control" type="number" step=".01" name="price" value="{{ $product->Price }}"/>

          @error('price')
          <p class="alert alert-danger mt-2">{{ $message }}</p>
          @enderror
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="in_stock">In stock?</label>
          @if($product->InStock)
          <input type="hidden" id="in_stock" name="inStock" value="0">
          <input type="checkbox" id="in_stock" name="inStock" value="1" checked>
          @else
          <input type="hidden" id="in_stock" name="inStock" value="0" checked>
          <input type="checkbox" id="in_stock" name="inStock" value="1">
          @endif
        </fieldset>
        
        <button id="submit" class="btn btn-primary flex-grow-1 mt-3 mb-3 p-2 border-bottom">Update Product</button>
      </form>

      <form method="POST" action="/products/{{ $product->ProductId }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">
            <i class="fa-solid fa-trash"></i> Delete
        </button>
      </form>
    </section>
  </div>
</x-layout>