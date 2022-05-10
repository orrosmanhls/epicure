<section class="mobile-nav-section">
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
</section>
