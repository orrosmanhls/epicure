@include('sections.mobile-menu')
@include('sections.mobile-search')
<header class="header">
  <div class="header-left">
    <div class="brand">
      <a href="{{ home_url('/') }}">
        <img class="brand-image" src="{{ asset('/images/logo.png')  }}" alt="logo">
        <span>EPICURE</span>
      </a>
    </div>

    <div class="pages-nav">
      <span id="mobile-menu-btn">
        <x-button-icon source="{{ asset('../images/mobile-menu.svg') }}" />
      </span>
      <?php
          $args = array(
              'menu'=>  'pages',
              'theme_location'  =>  'pages',
              'container'       => 'nav',
              'container_class' => 'pages',
              'container_id'    => 'pages',
          );
          wp_nav_menu($args);
          ?>
    </div>
  </div>


  <div class="header-right">
    <x-search-input>
      @section('icon')
      <x-button-icon source="{{ asset('../images/search-icon.svg') }}" />
      @endsection
    </x-search-input>
  </div>
</header>
