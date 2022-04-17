<div class="download-button text-center">
  <a href="#">
    @switch($type)
    @case('apple')
    <img src="{{ asset('/images/apple-store.svg') }}" alt="{{ $type }}">
    <span>Download on the <div>App Store</div></span>
    @break
    @case('google')
    <img src="{{ asset('/images/google-play.svg')}}" alt="{{ $type }}">
    <span>Get it on <div>Google Play</div></span>
    @break
    @endswitch
  </a>
</div>
