@section('title', 'Consumer Behavior Report')
<x-layout>
    <div class="container">
      <section class="search-reports-page">
        <h1>Consumer Behavior Report</h1>

        <ul>
          <li><a href="#most-viewed-products">Most Viewed Products</a></li>
          <li><a href="#most-searched-brewers">Most Searched Brewers</a></li>
          <li><a href="#most-searched-brands">Most Searched Brands</a></li>
          <li><a href="#recent-searches">Recent Searches</a></li>
        </ul>

        <form class="" method="POST" action="/reports/deleteall">
          @csrf
          <button class="btn btn-danger" type="submit">Clear All Data</button>
        </form>
      </section>

      <!-- MOST VIEWED PRODUCTS -->
      <section id="most-viewed-products" class="report-section">
        <h3>Most Viewed Products</h3>
              
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Product</th>
              <th scope="col">Views</th>
            </tr>
          </thead>
          <tbody>
          @foreach($mostViewed as $mv)
            <tr>
              <th scope="row">{{ $loop->index + 1 }}</th>
              <td>{{ $mv->Brand }} by {{ $mv->Brewer }}</td>
              <td>{{ $mv->Views }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </section>

      <!-- MOST SEARCHED BREWERS -->
      <section id="most-searched-brewers" class="report-section">
        <h3>Most Searched Brewers</h3>
        
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Brewer</th>
                <th scope="col">Searches</th>
              </tr>
            </thead>
            <tbody>
            @foreach($brewerSearches as $brewerSearch)
              <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $brewerSearch->Brewer }}</td>
                <td>{{ $brewerSearch->Count }}</td>
              </tr>
            @endforeach
            </tbody>
        </table>
      </section>

      <!-- MOST SEARCHED BRANDS -->
      <section id="most-searched-brands" class="report-section">
        <h3>Most Searched Brands</h3>
        
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Brand</th>
                <th scope="col">Searches</th>
              </tr>
            </thead>
            <tbody>
            @foreach($brandSearches as $brandSearch)
              <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $brandSearch->Brand }}</td>
                <td>{{ $brandSearch->Count }}</td>
              </tr>
            @endforeach
            </tbody>
        </table>
      </section>

      <!-- RECENT SEARCHES -->
      <section id="recent-searches" class="report-section">
        <h3>Recent Searches</h3>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Brewer</th>
                <th scope="col">Brand</th>
                <th scope="col">Style</th>
                <th scope="col">ABV</th>
                <th scope="col">IBU</th>
                <th scope="col">SRM</th>
                <th scope="col">Page</th>
                <th scope="col">Time</th>
              </tr>
            </thead>
            <tbody>
            @foreach($allSearches as $allSearch)
              <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $allSearch->Brewer }}</td>
                <td>{{ $allSearch->Brand }}</td>
                <td>{{ $allSearch->PrimaryStyle }}</td>
                <td>{{ $allSearch->Abv }}</td>
                <td>{{ $allSearch->Ibu }}</td>
                <td>{{ $allSearch->Srm }}</td>
                <td>{{ $allSearch->ResultPage }}</td>
                <td>{{ $allSearch->created_at }}</td>
              </tr>
            @endforeach
            </tbody>
        </table>
      </section>
    </div>
</x-layout>