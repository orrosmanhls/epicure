@extends('layouts.app')

@section('content')

@include('sections.hero')
@include('sections.mobile-nav-section')
@include('sections.homepage-restaurants',['restaurants_per_page'=>3])
@include('sections.signature-dishes',['dishes_per_page'=>3])
@include('sections.icon-definitions')
@include('sections.week-chef')
@include('sections.about-us')

@endsection
