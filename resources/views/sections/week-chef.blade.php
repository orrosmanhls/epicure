<section class="chef-of-the-week">

  <h1 class="text-center">CHEF OF THE WEEK:</h1>

  @php $chef =epicure_random_chef() @endphp

  <div class="chef-info">
    <x-chef-front-image source="{{ $chef->image }}" alt="chef" name="{{ $chef->name }}" />
    <p>{{ $chef->info }}</p>
  </div>

  <div class="container">

    <h3>{{ explode(' ', $chef->name)[0] }}'s restaurants:</h3>

    <ul class="restaurants-list">
      @foreach($chef->restaurants as $restaurant)
      <li class="restaurant-card">
        <x-restaurant-card source="{{ $restaurant->image }}" name="{{ $restaurant->name }}" />
      </li>
      @endforeach
    </ul>

  </div>


</section>
