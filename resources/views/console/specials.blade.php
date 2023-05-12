@section('title', 'Specials')
<x-layout>
  <div class="col-md-12 mx-auto">

    <!-- BREWER BY AVG PRODUCT PRICE -->
    <section class="specials-section p-2 pt-1 pb-3">
      <h3 class="pt-2 ps-2 pe-2">Products by Price</h3>
      <table class="table mb-0 pb-0">
        <thead>
          <tr>
            <th scope="col">Price</th>
            <th scope="col"># of Products</th>
            <th scope="col">Link</th>
          </tr>
        </thead>
        <tbody>
        @foreach($prices as $p)
          <tr>
            <td>${{ $p->Price }}</td>
            <td>{{ $p->count }}</td>
            <td><a href="/?price={{ $p->Price }}">View Products</a></td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </section>


    <!-- BREWER BY AVG PRODUCT PRICE -->
    <section class="specials-section mt-3 p-2 pt-1 pb-3">
      <h3 class="pt-2 ps-2 pe-2">Average Product Price per Brewer</h3>

      <table class="table mb-0 pb-0">
        <thead>
          <tr>
            <th scope="col">Brewer</th>
            <th scope="col"># of Products</th>
            <th scope="col">Average Product Price</th>
          </tr>
        </thead>
        <tbody>
        @foreach($brewers as $b)
          <tr>
            <td><a href="/?brewer={{ urlencode($b->Brewer) }}">{{ $b->Brewer }}</a></td>
            <td>{{ $b->count }}</td>
            <td>${{ number_format($b->AvgPrice, 2, '.', ',') }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </section>
  </div>

  <a href="#" class="btt">Back to Top</a>
</x-layout>