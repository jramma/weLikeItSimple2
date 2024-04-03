{{-- @include('partials.header') --}}

  <main id="main" class="main">
    @yield('content')
  </main>

{{-- @include('partials.footer') --}}

{{-- Grid && Screen size --}}
@if(App::environment('development') || App::environment('staging'))
<section id="debug-dev" class="absolute">
  @include('debug.screen')
  @include('debug.grid')
</section>
@endif
