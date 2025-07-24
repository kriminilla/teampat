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
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-sm text-gray-700 hover:text-blue-600 transition">
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
                    <form method="POST" action="#">
                        @csrf
                        <button type="submit"
                            class="text-sm bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">
                            Logout
                        </button>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </nav>
