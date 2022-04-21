<section class="restaurants">

  @php $restaurants =epicure_restaurants_list($restaurants_per_page)@endphp

  <div class="container">
    <ul class="restaurants-list">
      @foreach($restaurants as $restaurant)
      <li class="restaurant-card">
        <x-restaurant-card source="{{ $restaurant->image }}" name="{{ $restaurant->name }}"
          chef="{{ $restaurant->chef }}" />
      </li>
      @endforeach
    </ul>

  </div>

</section>
