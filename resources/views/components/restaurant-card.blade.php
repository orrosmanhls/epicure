<img src="{{ $source }}" alt="{{ $name }}">
<div class="restaurant-card-content">
  <h1>{{ $name }}</h1>

  @if(!empty($chef))
  <p>{{ $chef }}</p>
  @endif

</div>
