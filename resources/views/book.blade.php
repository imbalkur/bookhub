@extends('index')

@section('content')
    <div class="flex justify-around items-center books container mx-auto my-5">
        @foreach ($books as $book)
            <div class="shadow-lg m-5 p-5 book-card">
                <h3 class="font-bold">{{ $book->name }}</h3>
                <h4 class="text-red-700">{{ $book->author }}</h4>
                <img src="{{ asset('images/' . $book->cover_image) }}" class="cover-image mx-auto p-3" alt="" srcset="">
                <h5 class="font-bold text-xl text-center text-orange-600 my-5">Price ₹ {{ $book->price }}</h5>
                <a href="{{ url('addtocart/' . $book->id) }}" class="px-5 py-2 text-white bg-orange-800 uppercase rounded">
                    Add to Cart
                </a>
            </div>
        @endforeach
    </div>
@endsection
