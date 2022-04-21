<div class="filter-bar">
  <ul class="tabs">
    @foreach ($filters as $filter)
    <li class="tab">
      <a href="">{{ $filter }}</a>
    </li>
    @endforeach
  </ul>
</div>
