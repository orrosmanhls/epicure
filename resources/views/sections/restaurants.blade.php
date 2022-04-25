<section class="restaurants">

  @php $restaurants =epicure_restaurants_list($restaurants_per_page)@endphp
  @component('components.filter-bar',['filters'=>array('All','New','Most Popular','Open
  Now'),'restaurants'=>$restaurants])
  @endcomponent

  <div class="container">
    <ul class="restaurants-list">
      @foreach($restaurants as $restaurant)

      @switch($filter)
      @case('Open Now')
      @if(is_open($restaurant->opening_hour,$restaurant->closing_hour))
      <li class="restaurant-card">

        @component('components.restaurant-card',
        ['source'=>$restaurant->image,'name'=>$restaurant->name,'chef'=>$restaurant->chef])
        @endcomponent

      </li>
      @endif
      @break

      @default
      <li class="restaurant-card">

        @component('components.restaurant-card',
        ['source'=>$restaurant->image,'name'=>$restaurant->name,'chef'=>$restaurant->chef])
        @endcomponent

      </li>

      @endswitch

      @endforeach
    </ul>

  </div>

</section>
