{{--
  Template Name: Home
--}}

@extends('layouts.app')

@section('content')
  @include('components.home.title')
  @include('components.home.testimonials')
  @include('components.home.flexible-content')
@endsection
