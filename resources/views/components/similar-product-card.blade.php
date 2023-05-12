<div class="col-5">
  <div class="card pc-card">
    <figure class="pc-figure">
      @if($p->ImgFile)
      <img src="{{ asset('images/' . $p->ImgFile) }}" class="pc-img" alt="{{ $p->Brand }} by {{ $p->Brewer }}" width="100%">
      @else
      <img src="{{ asset('images/placeholder.jpg') }}" class="pc-img" alt="{{ $p->Brand }} by {{ $p->Brewer }}" width="100%"> 
      @endif
    </figure>

    <div class="pc-info">
        
      <div class="pc-title">
        <a href="/products/{{ $p->ProductId }}" class="stretched-link">{{ $p->Brand }}</a>
      </div>

      <span class="pc-brewer">{{ $p->Brewer }}</span>

      <ul class="pc-vitals">
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

        <ul class="pc-price-stock">
          <li class="pc-price"><b>${{ $p->Price }}</b></li>

          @if($p->InStock)
            <li class="pc-stock">
              <span class="alert alert-success p-1">In Stock</span>
            </li>
          @else
            <li class="pc-stock">
              <span class="alert alert-danger p-1">Out of Stock</span>
            </li>
          @endif
        </ul>


        </ul>
    </div>
  </div>
</div>