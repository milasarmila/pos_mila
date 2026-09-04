<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Kode CSS Global untuk Tema Maroon Proyek Anda -->
   <style>
  /* Menyetel latar belakang seluruh baris navbar menjadi Maroon Polos */
  .custom-navbar-maroon {
    background-color: #800020 !important;
  }

  /* Efek saat menu teks putih transparan disorot kursor (hover) */
  .navbar-nav .nav-link.custom-nav-item:hover {
    color: #ffffff !important; /* Menjadi putih terang saat disentuh */
    background-color: rgba(255, 255, 255, 0.1); /* Efek kotak tipis transparan */
    transition: all 0.2s ease-in-out;
  }
</style>

</head>
<body>
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
