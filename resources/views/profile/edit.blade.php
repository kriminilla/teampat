<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profil Saya - SimpleShop</title>
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

                <!-- Menu Profil -->
                <div class="flex items-center space-x-4">
                    <!-- Tombol Dashboard -->
                    <a href="{{ route('products') }}" class="flex items-center gap-2 text-sm text-gray-700 hover:text-blue-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span>Dashboard</span>
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
            </div>
        </div>
    </nav>

    <!-- Isi Halaman Profil -->
    <main class="flex-grow max-w-screen-xl mx-auto mt-10 px-4">
        <!-- Card Profil -->
        <div class="bg-white p-10 shadow-2xl border border-gray-200 rounded-3xl w-full max-w-3xl mx-auto">
            <!-- Header Profil -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900">Profil Saya</h1>

                <!-- Notifikasi -->
                @if(session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-md text-sm flex items-center shadow-md">
                    <span>{{ session('status') }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-2 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                @endif
            </div>

            <!-- Form Profil -->
            <form method="POST" action="{{ route('profile.update') }}" class="w-full space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div>
                    <label for="name" class="block text-base font-semibold text-gray-700 mb-1">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg">
                    @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-base font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg">
                    @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Simpan -->
                <div class="pt-6">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white px-6 py-3 text-lg font-semibold rounded-lg hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
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
