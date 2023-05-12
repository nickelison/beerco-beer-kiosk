<footer class="py-3 my-2 border-top container">
  <div class="row justify-content-end">
    <div class="col-4 d-flex justify-content-center">    
      <span class="text-muted">© 2022 Beerco Beer Kiosk</span>
    </div>

    <div class="col-4 d-flex justify-content-end">
      @if(Auth::check())
      @else
        <a class="text-muted" href="/login">Admin Login</a>
      @endif
    </div>
  </div>
</footer>