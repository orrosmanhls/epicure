<div id="mobile-menu">
    <div id="mobile-menu-close-btn">
        <x-button-icon source="{{ asset('../images/x.svg') }}" />
    </div>
    <div class="content">
        @php
            $args = [
                'menu' => 'pages',
                'theme_location' => 'pages',
                'container' => 'nav',
                'container_class' => 'pages',
                'container_id' => 'pages',
            ];
            wp_nav_menu($args);
        @endphp
        <div class="divider"></div>
        <div class="links">
            <a href="/coming-soon">Sign in</a>
            <a href="/coming-soon">Contact us</a>
            <a href="/coming-soon">Terms of Use</a>
        </div>
    </div>
</div>
