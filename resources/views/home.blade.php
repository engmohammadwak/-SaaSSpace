@extends('layouts.app')

@section('content')
    @include('partials.hero', ['hero' => $hero])
    @include('partials.about', ['settings' => $settings])
    @include('partials.clients', ['clients' => $clients])
    @include('partials.services', ['services' => $services])
    @include('partials.case-studies', ['projects' => $projects])
    @include('partials.testimonials', ['testimonials' => $testimonials])
    @include('partials.pricing', ['pricingPlans' => $pricingPlans])
@endsection
