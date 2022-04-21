<section class="restaurants">

  @php $restaurants =epicure_restaurants_list($restaurants_per_page)@endphp

  @component('components.filter-bar',['filters'=>array('All','New','Most Popular','Open Now')])
  @endcomponent

  <div class="container">
    <ul class="restaurants-list">
      @foreach($restaurants as $restaurant)
      <li class="restaurant-card">

        @component('components.restaurant-card',
        ['source'=>$restaurant->image,'name'=>$restaurant->name,'chef'=>$restaurant->chef])
        @endcomponent

      </li>
      @endforeach
    </ul>

  </div>

</section>
