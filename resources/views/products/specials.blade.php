@section('title', 'Specials')
<x-layout>
  <h1>Specials</h1>

  <div class="col-md-12 mx-auto">

    <!-- BREWER BY AVG PRODUCT PRICE -->
    <section class="specials-section p-2 pt-1 pb-3">
      <h3 class="pt-2 ps-2 pe-2">Shop by Price Point</h3>
      <table class="table mb-0 pb-0">
        <thead>
          <tr>
            <th scope="col">Price</th>
            <th scope="col"># of Beers</th>
            <th scope="col">Link</th>
          </tr>
        </thead>
        <tbody>
        @foreach($prices as $p)
          <tr>
            <td>${{ $p->Price }}</td>
            <td>{{ $p->count }}</td>
            <td><a href="/?price={{ $p->Price }}">Shop Now</a></td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </section>
  </div>
</x-layout>