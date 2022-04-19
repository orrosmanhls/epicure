<section class="restaurants">

  <h2 class="text-center">THE POPULAR RESTAURANTS IN EPICURE:</h2>

  @php $restaurants =epicure_restaurants_list(3)@endphp

  <div class="container">
    <ul class="restaurants-list">
      @foreach($restaurants as $restaurant)
      <li class="restaurant-card">
        <x-restaurant-card source="{{ $restaurant->image }}" name="{{ $restaurant->name }}"
          chef="{{ $restaurant->chef }}" />
      </li>
      @endforeach
    </ul>

    <a href="/restaurants" class="all-restaurants">
      All Restaurants >>
    </a>
  </div>


</section>
