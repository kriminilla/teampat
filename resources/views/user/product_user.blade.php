<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Simple Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-blue-600 tracking-wide">SimpleShop</span>
                </div>

                <!-- Jika belum login -->
                @guest
                <div>
                    <a href="{{ route('login.form') }}" class="text-sm bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                        Login
                    </a>
                </div>
                @endguest

                <!-- Jika sudah login -->
                @auth
                <div class="flex items-center space-x-4">
                    <!-- Tombol Profil -->
                    <a href="{{ route('products') }}" class="flex items-center gap-2 text-sm text-gray-700 hover:text-blue-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 20.25a8.25 8.25 0 0115 0" />
                        </svg>
                        <span>Profil</span>
                    </a>

                    <!-- Tombol Logout -->
                    <a href="{{ route('logout') }}">
                        <button type="submit"
                            class="text-sm bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">
                            Logout
                        </button>
                    </a>
                    <form method="POST" action="">
                        @csrf
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Isi Dashboard -->
    <main class="flex-grow max-w-screen-xl mx-auto mt-10 px-4">

        <!-- Welcome + Search -->
        <div class="bg-white p-8 shadow-sm rounded-xl mb-10 text-center">
            <h1 class="text-3xl font-semibold text-gray-800 mb-2">Selamat Datang Di SimpleShop</h1>
            <p class="text-gray-500 mb-6 text-sm">
                Kami hadir untuk membantu kemudahan anda dalam berbelanja.
            </p>

            <!-- Search Bar -->
            <form action="{{ route('products') }}" method="GET" class="max-w-lg mx-auto flex items-center bg-gray-100 rounded-full overflow-hidden">
                <input
                    type="text"
                    name="query"
                    value="{{ request('query') }}"
                    placeholder="Cari produk..."
                    class="w-full px-4 py-2 bg-transparent focus:outline-none text-sm" />
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-r-full text-sm hover:bg-blue-700 transition">
                    Cari
                </button>
            </form>
        </div>

        <!-- Daftar Produk -->
        <div class="bg-white p-8 shadow-md rounded-2xl">
            <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Produk Kami</h2>

            @if(isset($query) && $query)
            <p class="text-sm mb-4">Hasil pencarian untuk: <strong>{{ $query }}</strong></p>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($produks as $produk)
                <!-- satu kartu produk -->
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition">
                    <div class="overflow-hidden">
                        <img src="{{ $produk->gambar }}"
                            alt="{{ $produk->nama }}"
                            class="w-full h-48 object-cover transition-transform duration-300 hover:scale-105" />
                    </div>
                    <div class="p-4 flex flex-col justify-between h-[160px]">
                        <h3 class="font-semibold text-lg text-gray-800">{{ $produk->nama }}</h3>

                        <!-- Tampilkan nama kategori -->
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $produk->kategori->nama ?? '-' }}
                        </p>

                        <p class="text-blue-600 text-base font-bold mt-2">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </p>
                        <a href="/produk/{{ $produk->id }}"
                            class="mt-4 bg-blue-600 text-white text-sm px-4 py-2 rounded-md text-center hover:bg-blue-700 transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white mt-16 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col items-center text-sm text-gray-500 text-center">
            <p class="mb-1 font-medium text-gray-700">Belanja Mudah, Hidup Lebih Ringkas.</p>
            <p>&copy; 2025 SimpleShop. Semua hak dilindungi.</p>
        </div>
    </footer>

</body>
</html>






