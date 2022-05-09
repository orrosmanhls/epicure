<header class="header">
  <div class="header-left">
    <div class="brand">
      <a href="{{ home_url('/') }}">
        <img class="brand-image" src="{{ asset('/images/logo.png')  }}" alt="logo">
        <span>EPICURE</span>
      </a>
    </div>
    <div class="pages-nav">
      <x-button-icon source="{{ asset('../images/mobile-menu.svg') }}" />
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
    <div class="user">
      <x-search-input>
        @section('icon')
        <x-button-icon source="{{ asset('../images/search-icon.svg') }}" />
        @endsection
      </x-search-input>
      <x-button-icon source="{{ asset('../images/user-icon.svg') }}" alt_text="user icon" />
      <x-button-icon source="{{ asset('../images/bag-icon.svg') }}" alt_text="bag icon" />
    </div>
  </div>
</header>
