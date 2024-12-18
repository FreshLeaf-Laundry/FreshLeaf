{{-- Extend the main layout --}}
@extends('layouts.app')

{{-- Page-specific title --}}
@section('title', 'Our Laundry Services')

{{-- Main content section --}}
@section('content')
<div class="services-container">
    {{-- Page Header --}}
    <header class="services-header">
        <h1>Our Comprehensive Laundry Services</h1>
        <p>Quality cleaning for every type of fabric and need</p>
    </header>

    {{-- Services Grid --}}
    <section class="services-grid">
        {{-- Individual Service Cards --}}
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-tshirt"></i>
            </div>
            <h2>Wash & Fold</h2>
            <p>Convenient service for everyday clothing. We'll wash, dry, and fold your items with care.</p>
            <ul class="service-details">
                <li>Per pound pricing</li>
                <li>24-hour turnaround</li>
                <li>Sorted by color and fabric type</li>
            </ul>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-shirt"></i>
            </div>
            <h2>Dry Cleaning</h2>
            <p>Specialized cleaning for delicate and formal garments, ensuring pristine condition.</p>
            <ul class="service-details">
                <li>Suits and evening wear</li>
                <li>Delicate fabrics</li>
                <li>Stain removal experts</li>
            </ul>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-blanket"></i>
            </div>
            <h2>Comforter & Bulk Cleaning</h2>
            <p>Special handling for large items like comforters, blankets, and heavy fabrics.</p>
            <ul class="service-details">
                <li>Large item specialists</li>
                <li>Gentle cleaning process</li>
                <li>Sanitization available</li>
            </ul>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-soap"></i>
            </div>
            <h2>Eco-Friendly Cleaning</h2>
            <p>Environmentally conscious cleaning using green technologies and biodegradable detergents.</p>
            <ul class="service-details">
                <li>Hypoallergenic options</li>
                <li>Reduced water usage</li>
                <li>Environmentally safe chemicals</li>
            </ul>
        </div>
    </section>

    {{-- Additional Information --}}
    <section class="additional-info">
        <h2>Why Choose Our Laundry Services?</h2>
        <div class="info-grid">
            <div class="info-item">
                <i class="fas fa-clock"></i>
                <h3>Fast Turnaround</h3>
                <p>Most orders completed within 24-48 hours.</p>
            </div>
            <div class="info-item">
                <i class="fas fa-shield-alt"></i>
                <h3>Guaranteed Quality</h3>
                <p>We treat each garment with the utmost care and respect.</p>
            </div>
            <div class="info-item">
                <i class="fas fa-tags"></i>
                <h3>Competitive Pricing</h3>
                <p>Affordable rates without compromising on quality.</p>
            </div>
        </div>
    </section>

    {{-- Contact Information --}}
    <section class="contact-info">
        <h2>Contact Us</h2>
        <p>Ready to get your laundry cleaned? Reach out to us:</p>
        <div class="contact-details">
            <p><strong>Phone:</strong> (555) 123-4567</p>
            <p><strong>Email:</strong> services@laundrydepot.com</p>
            <p><strong>Address:</strong> 123 Clean Street, Laundryton, ST 12345</p>
        </div>
    </section>
</div>
@endsection

{{-- Optional page-specific scripts --}}
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Example: Add hover effects to service cards
        const serviceCards = document.querySelectorAll('.service-card');
        serviceCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.classList.add('card-hover');
            });
            card.addEventListener('mouseleave', function() {
                this.classList.remove('card-hover');
            });
        });
    });
</script>
@endsection