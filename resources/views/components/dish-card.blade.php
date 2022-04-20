<h2>{{ $restaurant }}</h2>

<div class="dish-card-content" style="max-width:{{ $width }}px">
  <img class="dish-cover-image" src="{{ $source }}" alt="">

  <h1>{{ $name }}</h1>
  <p>{{ $ingredients }}</p>

  <div class="types">
    @foreach($types as $type)
    @if($type)
    @switch ($type)
    @case('Spicy')
    <img height="24px" class="dish-info-icon" src="{{ asset('images/spicy-icon.svg'); }}" alt=''>
    @break;
    @case('Vegetarian')
    <img height="24px" class="dish-info-icon" src="{{ asset('images/vegetarian-icon.svg'); }}" alt=''>
    @break;
    @case('Vegan')
    <img height="24px" class="dish-info-icon" src="{{ asset('images/vegan-icon.svg'); }}" alt=''>
    @break;
    @default
    @endswitch
    @endif
    @endforeach
  </div>

  <h3 class="price">
    <span>₪{{ $price }}</span>
  </h3>

</div>
