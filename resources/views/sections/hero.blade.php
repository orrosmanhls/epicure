<section class="hero">
  <img src="{{ asset('../images/hero-picture.png') }}" alt="hero">
  <div class="hero-text">

    <span>Epicure works with the top</span>
    <br>
    <span> chef restaurants in Tel Aviv</span>

    <x-search-input>
      @section('icon')
      <x-button-icon source="{{ asset('../images/search-icon.svg') }}" />
      @endsection
    </x-search-input>
  </div>
</section>
