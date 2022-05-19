@extends('index')

@section('content')
    @if (count($orders) > 0)
        <table class="cart-table">
            <thead>
                <tr class="bg-blue-200">
                    <th> </th>
                    <th>Book Name</th>
                    <th>Book Author</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
            </thead>

            @foreach ($orders as $order)
                @php
                    $book = $books->where('id', '=', $order->book_id)->first();
                @endphp
                <tr>
                    <td><img src="{{ asset('images/' . $book['cover_image']) }}" alt="" srcset="" class="cart-image">
                    </td>
                    <td>{{ $book['name'] }}</td>
                    <td>{{ $book['author'] }}</td>
                    <td>{{ $book['price'] }}</td>
                    <td>{{ $order->quantity }}</td>
                </tr>
            @endforeach
        </table>

        <a href="{{ route('cancelOrder') }}" class="button bg-red-500 text-white rounded cancel-order flex">Cancel
            Orders</a>
    @else
        <p class="text-center">Empty</p><br>
        <p class="text-center">
            <a href="/" class="button px-5 py-2 bg-yellow-300 rounded font-bold">
                Continue Shopping
            </a>
        </p>
    @endif

@endsection
