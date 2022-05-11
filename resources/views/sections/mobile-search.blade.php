<section class="mobile-search">

    <div id="mobile-search-close-btn">
        <x-button-icon source="{{ asset('../images/x.svg') }}" />
    </div>

    @component('components.search-input')
        @section('icon')
            <x-button-icon source="{{ asset('../images/search-icon.svg') }}" />
        @endsection
    @endcomponent

</section>
