<section class="hero">
  <img src="{{ asset('../images/hero-picture.png') }}" alt="hero">
  <div class="hero-text">
    Epicure works with the top chef restaurants in Tel Aviv
    <x-search-input>
      @section('icon')
      <x-button-icon source="{{ asset('../images/search-icon.svg') }}" />
      @endsection
    </x-search-input>
  </div>
</section>
