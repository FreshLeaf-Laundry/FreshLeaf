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

     {{-- Custom CSS  --}}
    @yield('styles')
    @stack('styles')
</head>
<body>

    
     {{-- Nanti masuk sini  --}}
    <div class="container-fluid px-0">
        @yield('content')
    </div>
    

     {{-- Footer   --}}
    @include('layouts.footer')
    
     {{-- Bootstrap 5 JS Bundle with Popper  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
     {{-- Custom Scripts  --}}
    @yield('scripts')
</body>
</html>
<style>
    body{
        font-family: 'Poppins', sans-serif;
    }
    :root{
        --hijau-tua-primary: #347928;
        --hijau-muda-secondary: #C0EBA6;
        --krem-primary: #FFFBE6;
        --kuning-secondary: #FCCD2A;
    }
</style>