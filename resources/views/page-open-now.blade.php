@extends('layouts.app')

@section('content')

@include('sections.restaurants',['restaurants_per_page'=> -1,'filter'=>'Open Now'])

@endsection
