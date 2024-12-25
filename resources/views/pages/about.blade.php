@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="container mt-4">
    <div class="row fade-in">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-4 mb-4">About Our Eco-Friendly Laundry</h1>
            <p class="lead mb-5">Kami membersihkan pakaian Anda sembari menjaga planet Anda tetap bersih.</p>
        </div>
    </div>

    <div class="row mb-5 align-items-center slide-in-left">
        <div class="col-md-6">
            <img src="{{ asset('images/ecofriendlydetergent.jpg') }}" alt="Eco-friendly Detergent" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6">
            <h2 class="mb-4">Detergen Ramah Lingkungan</h2>
            <p>Layanan Laundry kami hanya menggunakan detergen yang dapat terurai secara alami dan tidak mengandung fosfat yang ramah lingkungan. Detergen ini efektif menghilangkan noda dan meminimalkan dampak pencemaran lingkungan.</p>
        </div>
    </div>

    <div class="row mb-5 align-items-center slide-in-right">
        <div class="col-md-6 order-md-2">
            <img src="{{ asset('images/waterconservation.jpg') }}" alt="Water Conservation" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6 order-md-1">
            <h2 class="mb-4">Penghematan Air</h2>
            <p>Kami hanya menggunakan mesin cuci yang efisien air dan sistem pengelolaan limbah untuk mengeliminasi polusi air. Proses ini membantu menghemat air hingga 40% dibandingkan dengan layanan laundry tradisional.</p>
        </div>
    </div>

    <div class="row mb-5 align-items-center slide-in-left">
        <div class="col-md-6">
            <img src="{{ asset('images/energyefficient.jpg') }}" alt="Energy Efficient" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6">
            <h2 class="mb-4">Penghematan Energi</h2>
            <p>Fasilitas kami dilengkapi dengan mesin cuci yang efisien energi dan panel surya, mengurangi carbon footprint kami dan pengguna kami serta mempertahankan standar kualitas pencucian tertinggi.</p>
        </div>
    </div>

    <div class="row fade-in">
        <div class="col-lg-8 mx-auto text-center my-5">
            <h2 class="mb-4">Komitmen Menjaga Lingkungan</h2>
            <p class="mb-5">Kami percaya dalam menyediakan layanan laundry yang luar biasa sambil menjaga lingkungan kami untuk generasi mendatang. Pilih kami untuk pakaian dan planet yang lebih bersih.</p>
            <a href="https://www.youtube.com/watch?v=Ec4YbVP9R-A" class="btn btn-light primarybutton" target="_self">Hubungi Kami</a>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .img-fluid {
        max-height: 400px;
        object-fit: cover;
    }
    
    h2 {
        color: #2c3e50;
    }
    
    .lead {
        color: #34495e;
    }

    /* .btn.btn-primary {
        background-color: var(--krem-primary);
        color: #2B8761;
    } */
</style>
@endsection

@section('scripts')
<script>

</script>
@endsection