@extends('layouts.app')

@section('title', 'Fresh & Clean Laundry Services')

@section('content')
{{-- Hero Section --}}
<div class="container-fluid w-100 py-5 homecontainer">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <p class="lead mb-4">
                    Choose Green, Choose Fresh
                </p>
                <div class="display-4 herotext">
                    <span class="fw-bold">FreshLeaf</span> <span>Laundry</span>
                </div>
                
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                    Daftar Sekarang
                </a>

            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/hero-laundry.jpg') }}" 
                     alt="Laundry Services" 
                     class="img-fluid rounded-4 shadow-lg">
            </div>
        </div>
    </div>
</div>



{{-- About Section --}}
<div class="container-fluid py-5 yourbestcontainer">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img src="{{ asset('images/about-laundry.jpg') }}" 
                     alt="About Our Laundry" 
                     class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6">
                <h2 class="display-6 mb-4">Your Best Partner in Laundry Service</h2>
                <p class="lead mb-4">
                    Di FreshLeaf Laundry, kami memahami bahwa pakaian Anda adalah investasi. 
                    Dengan tenaga profesional yang terlatih dan berpengalaman, kami menjamin 
                    setiap pakaian ditangani dengan perhatian dan keahlian tinggi.
                </p>
                <p>
                    Kami menggunakan peralatan laundry terbaru untuk memberikan hasil yang optimal, 
                    memastikan pakaian Anda bersih dan terawat dengan baik. Selain itu, kami hanya 
                    menggunakan deterjen ramah lingkungan yang aman untuk Anda dan keluarga, 
                    serta efektif dalam menghilangkan noda. 
                </p>

            </div>

        </div>
    </div>
</div>

{{-- Customer Testimonials --}}
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="display-6">Mengapa Kami Yang Terbaik?</h2>

    </div>
    
    <div class="row g-4">
        {{-- Testimonial 1 --}}
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <p class="card-text fst-italic mb-4">
                        "FreshLeaf Laundry selalu memberikan hasil yang luar biasa!
                        Pakaian saya selalu bersih dan wangi. Pelayanan yang cepat dan ramah.
                        Sangat merekomendasikan!"
                    </p>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/customer1.jpg') }}" 
                             alt="Customer Testimonial" 
                             class="rounded-circle me-3" 
                             width="60" height="60">
                        <div>
                            <h6 class="mb-0">Jane Doe</h6>
                            <small class="text-muted">Pelanggan FreshLeaf</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- testi 2 --}}
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <p class="card-text fst-italic mb-4">
                        "FreshLeaf Laundry selalu memberikan hasil yang luar biasa!
                        Pakaian saya selalu bersih dan wangi. Pelayanan yang cepat dan ramah.
                        Sangat merekomendasikan!"
                    </p>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/customer1.jpg') }}" 
                             alt="Customer Testimonial" 
                             class="rounded-circle me-3" 
                             width="60" height="60">
                        <div>
                            <h6 class="mb-0">Jane Doe</h6>
                            <small class="text-muted">Mitra FreshLeaf</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- testi 3 --}}
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <p class="card-text fst-italic mb-4">
                        "Saya sangat puas dengan layanan FreshLeaf Laundry. Tenaga profesional dan peralatan modern"
                    </p>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/customer1.jpg') }}" 
                             alt="Customer Testimonial" 
                             class="rounded-circle me-3" 
                             width="60" height="60">
                        <div>
                            <h6 class="mb-0">Jane Doe</h6>
                            <small class="text-muted">Mitra FreshLeaf</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection


<style>
    .card-img-top {
        height: 250px;
        object-fit: cover;
    }
    .lead{
        color: var(--hijau-tua-primary);
    }
    .herotext{
        margin: 0;
        color: var(--krem-primary);
        background-color: var(--hijau-tua-primary);
        padding-right: 0;
    }
    .homecontainer{
        background-color: var(--hijau-muda-secondary);
    }
    .yourbestcontainer{
        background-color: var(--krem-primary);
    }
    .col-lg-6 .btn-lg{
        margin-top: 15px;
        background-color: #2B8761;
        border: none;
    }
    .col-lg-6 .btn-lg:hover{
        color: #2B8761;
        background-color:var(--krem-primary);
    }
</style>
