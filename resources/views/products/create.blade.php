@section('title', 'Add a Beer')
<x-layout>
  <div class="col-md-8 mx-auto">
    <section class="add-product-form">
      <form method="POST" action="/products" enctype="multipart/form-data">
        @csrf

        <legend class="border-bottom mb-3">Add Product</legend>
        
        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="upc">UPC</label>
          <input class="form-control" type="number" name="upc" value="{{ old('upc')}}" tabindex="1"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="brand">Brand Name</label>
          <input class="form-control" type="text" name="brand" value="{{ old('brand')}}" tabindex="1"/>

          @error('brand')
          <p class="alert alert-danger mt-2">{{ $message }}</p>
          @enderror
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="brewer">Brewer</label>
          <input class="form-control" type="text" name="brewer" value="{{ old('brewer')}}" tabindex="1"/>

          @error('brewer')
          <p class="alert alert-danger mt-2">{{ $message }}</p>
          @enderror
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="image">Product Image</label>
          <input class="form-control" type="file" name="image"/>

          @error('image')
          <p class="alert alert-danger mt-2">{{ $message }}</p>
          @enderror
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="originRegion">Origin Region</label>
          <input class="form-control" type="text" name="originRegion" value="{{ old('originRegion')}}" tabindex="1"/>

          @error('originRegion')
          <p class="alert alert-danger mt-2">{{ $message }}</p>
          @enderror
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="originCountry">Origin Country</label>
          <input class="form-control" type="text" name="originCountry" value="{{ old('originCountry')}}" tabindex="1"/>

          @error('originCountry')
          <p class="alert alert-danger mt-2">{{ $message }}</p>
          @enderror
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="originState">Origin State</label>
          <input class="form-control" type="text" name="originState" value="{{ old('originState')}}" tabindex="1"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="originLocal">Origin Local</label>
          <input class="form-control" type="text" name="originLocal" value="{{ old('originLocal')}}" tabindex="1"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="tempStyle1">Temp Style 1</label>
          <input class="form-control" type="text" name="tempStyle1" value="{{ old('tempStyle1')}}" tabindex="1"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="tempStyle2">Temp Style 2</label>
          <input class="form-control" type="text" name="tempStyle2" value="{{ old('tempStyle2')}}" tabindex="1"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="primaryStyle">Primary Beer Style</label>
          <input class="form-control" type="text" name="primaryStyle" value="{{ old('primaryStyle')}}" tabindex="1"/>

          @error('primaryStyle')
          <p class="alert alert-danger mt-2">{{ $message }}</p>
          @enderror
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="primaryStyleDesc">Primary Beer Style Desc</label>
          <textarea class="form-control" type="text" name="primaryStyleDesc" placeholder="" value="{{ old('primaryStyleDesc')}}"  tabindex="1"></textarea>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="specificStyle">Specific Beer Style</label>
          <input class="form-control" type="text" name="specificStyle" value="{{ old('specificStyle')}}" tabindex="1"/>

          @error('specificStyle')
          <p class="alert alert-danger mt-2">{{ $message }}</p>
          @enderror
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="specificStyleDesc">Specific Beer Style Desc</label>
          <textarea class="form-control" type="text" name="specificStyleDesc" placeholder="" value="{{ old('specificStyleDesc')}}" tabindex="1"></textarea>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="foodPairing">Food Pairing</label>
          <input class="form-control" type="text" name="foodPairing" value="{{ old('foodPairing')}}" tabindex="1"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="oz">Size (oz)</label>
          <input class="form-control" type="number" step=".1" name="oz" value="{{ old('oz')}}" tabindex="1"/>

          @error('oz')
          <p class="alert alert-danger mt-2">{{ $message }}</p>
          @enderror
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="ml">Size (ml)</label>
          <input class="form-control" type="number" name="ml" value="{{ old('ml')}}" tabindex="1"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="container">Container</label>
          <input class="form-control" type="text" name="container" value="{{ old('container')}}" tabindex="1"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="packageType">Package Type</label>
          <input class="form-control" type="text" name="packageType" value="{{ old('packageType')}}" tabindex="1"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="abv">ABV</label>
          <input class="form-control" type="number" step=".1" name="abv" value="{{ old('abv')}}" tabindex="1"/>

          @error('abv')
          <p class="alert alert-danger mt-2">{{ $message }}</p>
          @enderror
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="ibu">IBU</label>
          <input class="form-control" type="number" step=".1" name="ibu" value="{{ old('ibu')}}" tabindex="1"/>

          @error('ibu')
          <p class="alert alert-danger mt-2">{{ $message }}</p>
          @enderror
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="srm">SRM</label>
          <input class="form-control" type="number" step=".1" name="srm" value="{{ old('srm')}}" tabindex="1"/>

          @error('srm')
          <p class="alert alert-danger mt-2">{{ $message }}</p>
          @enderror
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="malt">Malt</label>
          <input class="form-control" type="text" name="malt" value="{{ old('malt')}}" tabindex="1"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="hops">Hops</label>
          <input class="form-control" type="text" name="hops" value="{{ old('hops')}}" tabindex="1"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="calories">Calories</label>
          <input class="form-control" type="number" name="calories" value="{{ old('calories')}}" tabindex="1"/>
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label" for="description">Description</label>
          <textarea class="form-control" type="text" name="description" placeholder="" value="{{ old('description')}}" tabindex="1"></textarea>
        </fieldset>
        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="price">Price</label>            
          <input class="form-control" type="number" step=".01" name="price" value="{{ old('price')}}" tabindex="1"/>

          @error('price')
          <p class="alert alert-danger mt-2">{{ $message }}</p>
          @enderror
        </fieldset>

        <fieldset class="form-group mt-2">
          <label class="form-control-label required" for="in_stock" tabindex="1">In stock?</label>
          <input type="hidden" id="in_stock" name="inStock" value="0" checked>
          <input type="checkbox" id="in_stock" name="inStock" value="1">

          @error('inStock')
          <p class="alert alert-danger mt-2">{{ $message }}</p>
          @enderror
        </fieldset>

        <button id="submit" class="btn btn-primary flex-grow-1 mt-3 mb-1 p-2 border-bottom" tabindex="1">Add Product</button>
      </form>
    </section>
  </div>
</x-layout>