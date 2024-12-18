@extends('layouts.app')

@section('title', 'Fresh & Clean Laundry Services')

@section('content')
{{-- Hero Section --}}
<div class="container-fluid bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 mb-4">Fresh & Clean Laundry Services</h1>
                <p class="lead mb-4">
                    Transforming your dirty laundry into fresh, crisp, and perfectly clean clothes. 
                    Convenient, professional, and always reliable.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('services') }}" class="btn btn-primary btn-lg">
                        Our Services
                    </a>
                    <a href="{{ route('about') }}" class="btn btn-outline-primary btn-lg">
                        Book Now
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/hero-laundry.jpg') }}" 
                     alt="Laundry Services" 
                     class="img-fluid rounded-4 shadow-lg">
            </div>
        </div>
    </div>
</div>

{{-- Services Overview --}}
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="display-6">Our Laundry Services</h2>
        <p class="lead text-muted">
            Comprehensive solutions for all your laundry needs
        </p>
    </div>
    
    <div class="row g-4">
        {{-- Service Card 1: Wash & Fold --}}
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <img src="{{ asset('images/wash-fold.jpg') }}" 
                     class="card-img-top" 
                     alt="Wash & Fold Service">
                <div class="card-body">
                    <h5 class="card-title">Wash & Fold</h5>
                    <p class="card-text">
                        Quick and convenient service. We wash, dry, and fold your clothes 
                        with utmost care and precision.
                    </p>
                </div>
            </div>
        </div>

        {{-- Service Card 2: Dry Cleaning --}}
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <img src="{{ asset('images/dry-cleaning.jpg') }}" 
                     class="card-img-top" 
                     alt="Dry Cleaning Service">
                <div class="card-body">
                    <h5 class="card-title">Dry Cleaning</h5>
                    <p class="card-text">
                        Professional dry cleaning for delicate fabrics, suits, dresses, 
                        and special garments that require extra care.
                    </p>
                </div>
            </div>
        </div>

        {{-- Service Card 3: Alterations --}}
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <img src="{{ asset('images/alterations.jpg') }}" 
                     class="card-img-top" 
                     alt="Alterations Service">
                <div class="card-body">
                    <h5 class="card-title">Alterations</h5>
                    <p class="card-text">
                        Expert tailoring services to ensure your clothes fit perfectly 
                        and look their best.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- About Section --}}
<div class="container-fluid bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="display-6 mb-4">About Fresh & Clean Laundry</h2>
                <p class="lead mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam 
                    scelerisque id nunc nec volutpat. Etiam pellentesque tristique 
                    arcu, non consectetur magna consectetur in.
                </p>
                <p>
                    Praesent eget tortor sit amet magna pharetra fermentum. Etiam 
                    tempus, felis vel malesuada tincidunt, nisi enim commodo arcu, 
                    non consectetur magna tellus non ipsum.
                </p>
                <a href="{{ route('about') }}" class="btn btn-secondary mt-3">
                    Learn More About Us
                </a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/about-laundry.jpg') }}" 
                     alt="About Our Laundry" 
                     class="img-fluid rounded-4 shadow-lg">
            </div>
        </div>
    </div>
</div>

{{-- Customer Testimonials --}}
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="display-6">What Our Customers Say</h2>
        <p class="lead text-muted">
            Hear from satisfied customers who trust us with their laundry
        </p>
    </div>
    
    <div class="row g-4">
        {{-- Testimonial 1 --}}
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <p class="card-text fst-italic mb-4">
                        "Amazing service! My clothes always come back fresh, clean, 
                        and perfectly folded. Highly recommend!"
                    </p>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/customer1.jpg') }}" 
                             alt="Customer Testimonial" 
                             class="rounded-circle me-3" 
                             width="60" height="60">
                        <div>
                            <h6 class="mb-0">Jane Doe</h6>
                            <small class="text-muted">Regular Customer</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Similar structure for more testimonials --}}
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Optional custom styles */
    .card-img-top {
        height: 250px;
        object-fit: cover;
    }

</style>
@endsection