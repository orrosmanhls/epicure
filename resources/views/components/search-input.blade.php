<div class="search">
  @yield('icon')

  @php
  $categories =get_categories();
  $restaurants = epicure_restaurants_list();
  @endphp

  <input type="text" class="restaurants-value" value='@json($restaurants)' style="display:none">
  <input type="text" class="categories-value" value='@json($categories)' style="display:none">

  <input class="search-input" type="text" placeholder="Search for restaurants cuisine, chef" value="">
  <div class="search-results">

  </div>
</div>
