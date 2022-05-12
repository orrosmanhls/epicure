@extends('layouts.app')

@section('content')
    <section id="restaurants-page">
        @include('sections.restaurants', [
            'restaurants_per_page' => -1,
            'filter' => 'Most Popular',
        ])
    </section>
@endsection
