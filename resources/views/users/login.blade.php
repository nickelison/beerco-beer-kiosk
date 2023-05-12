@section('title', 'Admin Login')
<x-layout>
  <div class="col-md-8 mx-auto">
    <section class="login-form pt-2 ps-3 pe-3 pb-2">
      <form class="container mx-auto pt-0 pb-3 ps-0 pe-0" method="POST" action="/users/authenticate" role="form">
      @csrf
        <fieldset class="form-group">
          <legend class="border-bottom mb-3">Sign In</legend>

          <label class="form-control-label mt-2 required" for="email">Email</label>
          <input class="form-control" id="email" name="email" required="" tabindex="1" type="email" value="{{ old('email') }}">
          @error('email')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror

          <label class="form-control-label mt-2 required" for="password">Password</label>
          <input class="form-control" id="password" name="password" required="" tabindex="1" type="password" value="">
          @error('password')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror

          <div class="d-flex align-items-center mt-3">
            <input class="btn btn-primary flex-grow-1 p-2" id="submit" name="submit" tabindex="1" type="submit" value="Sign In">
          </div>
        </fieldset>
      </form>

      <span> Or <a href="/register" tabindex="1">register</a></span>
    </section>
  </div>
</x-layout>