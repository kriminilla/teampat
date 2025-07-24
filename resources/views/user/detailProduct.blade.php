@extends('user.master')

@section('title', 'Detail Product')

@section('content')
    <div class="bg-stone-50 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row -mx-4">
                <div class="md:flex-1 px-4">
                    <div class="h-[460px] rounded-lg bg-gray-300 dark:bg-gray-700 mb-4">
                        <img class="w-full h-full object-cover rounded-lg shadow"
                            src="{{ $produk->gambar }}" alt="{{ $produk->nama }}"/>
                    </div>
                    <div class="flex -mx-2 mb-4"></div>
                </div>
                <div class="md:flex-1 px-4">
                    <h2 class="text-4xl font-bold text-black-800 mb-5">{{ $produk->nama }}</h2>
                    <div class="flex mb-4">
                        <div class="mr-4">
                            <span class="text-2xl text-black-800">Rp. {{ number_format($produk->harga) }}</span>
                        </div>
                    </div>
                    <div>
                        <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />
                        <span class="text-1xl font-bold text-black-800">Product Description:</span>
                        <p class="text-gray-400 text-sm mt-2">
                            {{ $produk->deskripsi }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
