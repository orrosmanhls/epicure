<div id="mobile-menu">
  <div id="mobile-menu-close-btn">
    <x-button-icon source="{{ asset('../images/x.svg') }}" />
  </div>
  <div class="content">
    @php
    $args = array(
    'menu'=> 'pages',
    'theme_location' => 'pages',
    'container' => 'nav',
    'container_class' => 'pages',
    'container_id' => 'pages',
    );
    wp_nav_menu($args);
    @endphp
    <div class="divider"></div>
    <div class="links">
      <a href="">Sign in</a>
      <a href="">Contact us</a>
      <a href="">Terms of Use</a>
    </div>
  </div>
</div>
