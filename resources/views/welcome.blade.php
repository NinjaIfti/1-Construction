<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>1 Contractor | Construction Permitting Software</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    <!-- jQuery (needed for some components) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body class="font-sans antialiased text-gray-800">
    {{-- Include Navbar --}}
@include('components.navbar')

    {{-- Hero Section --}}
    @include('components.hero')

    {{-- About Section --}}
    @include('components.about')

    {{-- Services/Offer Section --}}
    @include('components.offer')

    {{-- Testimonial Section --}}
    @include('components.testimonial')

    {{-- CTA Section --}}
    @include('components.cta')

    {{-- Footer --}}
    @include('components.footer')


    
    <!-- App JS (load after direct script) -->
    <script src="{{ asset('resources/js/app.js') }}"></script>
</body>
</html>
