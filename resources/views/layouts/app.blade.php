<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    
    {{-- Bootstrap 5  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Fonts Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    {{-- Font Awesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Custom CSS  --}}
    {{-- @yield('styles') --}}
    @stack('styles')
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        :root {
            --hijau-tua-primary: #347928;
            --hijau-muda-secondary: #C0EBA6;
            --krem-primary: #FFFBE6;
            --kuning-secondary: #FCCD2A;
            --hijau-tua-secondary: #2B8761;
        }

        /* style untuk animasi */
            /* animasi */
        /* Animasi Fade In */
        .fade-in {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .fade-in.visible {
            opacity: 1;
        }

        /* Animasi Slide In */
        .slide-in-left {
            opacity: 0;
            transform: translateX(-150px);
            transition: all 0.5s ease-out;
        }

        .slide-in-left.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .slide-in-right {
            opacity: 0;
            transform: translateX(150px);
            transition: all 0.5s ease-out;
        }

        .slide-in-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        /* Hover Effect untuk Card */
        .card {
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }
        .btn.btn-light{
            color: var(--hijau-tua-primary);
            margin-left: 20px; 
            border: 2px solid var(--hijau-tua-primary); 
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .btn.btn-lg.secondarybutton{
            color: var(--hijau-tua-primary);
            margin-left: 20px; 
            background-color:var(--krem-primary); 
        }
        .btn.btn-lg.secondarybutton:hover{
            color: var(--krem-primary);
            background-color: var(--hijau-tua-secondary);
        }
    </style>



</head>
<body>
    {{-- Navbar   --}}
    @include('layouts.navbar')
    
    {{-- Main Content  --}}
    <div class="container-fluid px-0">
        @yield('content')
    </div>
    
    {{-- Footer   --}}
    @include('layouts.footer')
    
    {{-- Core Scripts (Always loaded) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Custom Scripts  --}}
    {{-- @stack('scripts') --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Intersection Observer untuk animasi fade dan slide
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1
        });

        // Amati semua elemen dengan kelas animasi
        document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right').forEach(element => {
            observer.observe(element);
        });
        });
    </script>
    @stack('scripts')

</body>
</html>
