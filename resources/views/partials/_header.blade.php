<header>
  @auth
  <nav class="navbar navbar-expand-lg bg-light pt-0 pb-0">
    <div class="container-md">
      <span class="navbar-brand">Admin Mode - {{ auth()->user()->email }}</span>
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="/console" class="nav-link">Management Console</a></li>
        <li class="nav-item">
          <form class="nav-link pb-0 pt-0" method="POST" action="/logout">
            @csrf
            <button class="btn no-btn nav-link" type="submit">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </nav>
  @endauth

  <nav class="navbar navbar-expand-lg border-bottom mb-3 beerco-nav">
    <div class="container-md">
      <a class="navbar-brand" href="/">Beerco Beer Kisok</a>
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="/" class="nav-link">Find a Beer</a></li>
        <li class="nav-item"><a href="/specials" class="nav-link">Specials</a></li>
      </ul>
    </div>
  </nav>
</header>