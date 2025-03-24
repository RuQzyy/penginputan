<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Pastikan video menutupi seluruh latar belakang */
        #backgroundVideo {
            position: fixed;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            object-fit: cover; /* Pastikan video tidak terdistorsi */
            z-index: -1; /* Mengirim video ke belakang konten lainnya */
            transform: translate(-50%, -50%) rotate(-90deg); /* Memutar video ke kiri */
            transform-origin: center center; /* Mengatur titik asal rotasi */
        }

        /* Gaya untuk logo sekolah */
        .logo {
            position: absolute;
            top: 120px; /* Jarak dari atas, sesuaikan sesuai kebutuhan */
            left: 50%;
            transform: translateX(-50%);
            width: 80px; /* Sesuaikan ukuran logo */
            height: 80px; /* Sesuaikan ukuran logo */
            border-radius: 50%; /* Membuat logo berbentuk bulat */
            z-index: 10; /* Pastikan logo di atas video */
            object-fit: cover; /* Pastikan logo tidak terdistorsi */
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <video id="backgroundVideo" autoplay muted loop playsinline>
        <source src="{{ asset('videos/hd.mp4') }}" type="video/mp4">
    </video>

    <!-- Logo Sekolah -->
    <img src="{{ asset('img/logo.png') }}" alt="Logo Sekolah" class="logo">

    <div class="bg-gray-800 bg-opacity-75 p-6 rounded-lg shadow-lg text-center w-full max-w-sm mt-32">
        <h1 class="text-2xl text-white mb-6 font-semibold">LOGIN</h1>

        <!-- Menampilkan Pesan Kesalahan -->
        @if ($errors->any())
            <div class="mb-4 text-red-500 text-sm bg-red-100 p-3 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Menampilkan Pesan Sukses -->
        @if (session('status'))
            <div class="mb-4 text-green-500 text-sm bg-green-100 p-3 rounded">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="mb-4">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" 
                       class="w-full p-2 rounded-full border border-blue-400 bg-transparent text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                       required autofocus>
            </div>
            <div class="mb-6 relative">
                <input type="password" name="password" id="password" placeholder="Password" 
                       class="w-full p-2 rounded-full border border-blue-400 bg-transparent text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                       required autocomplete="current-password">
                <span onclick="togglePassword()" class="absolute right-3 top-3 text-gray-400 cursor-pointer">
                    <i id="eyeIcon" class="fas fa-eye"></i>
                </span>
            </div>
            <button type="submit" class="w-full p-2 rounded-full border border-blue-400 text-white hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                Login
            </button>
        </form>

        <div class="flex justify-between mt-4 text-sm text-white">
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="hover:underline">Daftar</a>
            @endif

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="hover:underline">Lupa Password?</a>
            @endif
        </div>
    </div>

    <script>
        function togglePassword() {
            let passwordField = document.getElementById("password");
            let eye Icon = document.getElementById("eyeIcon");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }
    </script>
</body>
</html>