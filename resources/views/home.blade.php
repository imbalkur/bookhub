@extends('index')

@section('content')
    <div class="hero">
        <h3 class="hero-offer text-white font-bold text-5xl bg-yellow-400 py-2 px-5">Upto 40% off</h3>
        <h5 class="hero-numbooks text-white font-semibold text-3xl bg-red-400 my-3 py-2 px-5">1000+ books on deals</h5>
        <h3 class="hero-delivery text-white font-bold text-4xl bg-blue-400 mt-5 py-2 px-5 text-center">
            Free delivery on your first order
        </h3>
    </div>

    {{-- Success --}}
    @if (session('success'))
        <div class="error fixed p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert">
            <span class="font-medium">Success</span>
            <ul>
                <h1>{{ session('success') }}</h1>
            </ul>
        </div>
    @endif
    <h1 class="font-bold text-center text-4xl text-orange-900 my-5">Featured Books</h1>
    <div class="flex justify-around items-center books container mx-auto my-5">
        @foreach ($books as $book)
            <div class="shadow-lg m-5 p-5 book-card">
                <h3 class="font-bold">{{ $book->name }}</h3>
                <h4 class="text-red-700">{{ $book->author }}</h4>
                <img src="{{ asset('images/' . $book->cover_image) }}" class="cover-image mx-auto p-3" alt="" srcset="">
                <h5 class="font-bold text-xl text-center text-orange-600 my-5">Price ₹ {{ $book->price }}</h5>
                <a href="{{ url('addtocart/' . $book->id) }}"
                    class="px-5 py-2 text-white bg-orange-800 uppercase rounded">
                    Add to Cart
                </a>
            </div>
        @endforeach
    </div>
@endsection
