@extends('index')

@section('content')
    <div class="cart-table-div">
        @php
            if (Auth::id()) {
                $authcart = $carts->where('user_id', '=', Auth::id())->first();
                $sessionCart = false;
            } else {
                $authcart = false;
                $sessionCart = session('cart');
            }
        @endphp

        @if ($sessionCart || $authcart)
            <table class="cart-table">
                <thead>
                    <tr class="bg-blue-200">
                        <th></th>
                        <th> </th>
                        <th>Book Name</th>
                        <th>Book Author</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                        $quantity = 0;
                    @endphp
                    @guest
                        @foreach (session('cart') as $book)
                            @php
                                if ($book['is_checked'] === 'true') {
                                    $total += $book['quantity'] * $book['price'];
                                    $quantity += $book['quantity'];
                                }
                            @endphp
                        @endforeach

                        @foreach (session('cart') as $book)
                            <tr class="border-b border-blue-600">
                                <td>
                                    <input type="checkbox" data-id={{ $book['id'] }} name="buy" class="buy"
                                        {{ $book['is_checked'] === 'true' ? 'checked' : '' }}>
                                </td>
                                <td><img src="{{ asset('images/' . $book['image']) }}" alt="" srcset="" class="cart-image">
                                </td>
                                <td>{{ $book['name'] }}</td>
                                <td>{{ $book['author'] }}</td>
                                <td>₹ {{ $book['price'] }}</td>
                                <td>
                                    <input type="number" data-id={{ $book['id'] }} value="{{ $book['quantity'] }}"
                                        class="update-cart" name="quantity" min=1 max=10>
                                </td>
                                <td><a href="{{ url('removeFromCart/' . $book['id']) }}"
                                        class="button bg-red-500 rounded text-white">Remove</a></td>
                            </tr>
                        @endforeach

                    @endguest


                    {{-- auth --}}
                    @auth
                        @foreach ($carts as $cart)
                            @php
                                $book_item = $books->find($cart->book_id);
                                if ($cart->is_checked === 1) {
                                    $total += $cart->quantity * $book_item->price;
                                    $quantity += $cart->quantity;
                                }
                            @endphp
                            <tr class="border-b border-blue-600">
                                <td>
                                    <input type="checkbox" data-id={{ $cart['id'] }} name="buy" class="buy"
                                        {{ $cart['is_checked'] === 1 ? 'checked' : '' }}>
                                </td>
                                <td><img src="{{ asset('images/' . $book_item->cover_image) }}" alt="" srcset=""
                                        class="cart-image">
                                </td>
                                <td>{{ $book_item->name }}</td>
                                <td>{{ $book_item->author }}</td>
                                <td>₹ {{ $book_item->price }}</td>
                                <td>
                                    <input type="number" data-id={{ $cart['id'] }} value="{{ $cart['quantity'] }}"
                                        class="update-cart quantity" name="quantity" min=1 max=10>
                                </td>
                                <td><a href="{{ url('removeFromCart/' . $cart['id']) }}"
                                        class="button bg-red-500 rounded text-white">Remove</a></td>
                            </tr>
                        @endforeach
                    @endauth
                </tbody>
            </table>

            <div class="cart-total flex justify-between w-6/12 bg-green-100 items-center">
                @guest
                    <div class="flex items-center">
                        <p class="text-2xl"><span class="  uppercase">total</span> (
                            {{ $quantity }} items)</p>
                        <p class="mx-5 text-3xl font-bold">₹ {{ $total }}</p>
                    </div>
                    <div>
                        <a href="/loginCart" class="button bg-yellow-400 rounded font-bold">Buy Now</a>
                    </div>
                @endguest

                @auth
                    <div class="flex items-center">
                        <p class="text-2xl"><span class="  uppercase">total</span> (
                            {{ $quantity }} items)</p>
                        <p class="mx-5 text-3xl font-bold">₹ {{ $total }}</p>
                    </div>
                    <div>
                        <a href="{{ route('confirm-order') }}" class="button bg-yellow-400 rounded font-bold">Buy Now</a>
                    </div>
                @endauth
            </div>
        @else
            <p class="text-center">Empty Cart</p><br>
            <p class="text-center">
                <a href="/" class="button px-5 py-2 bg-yellow-300 rounded font-bold">
                    Continue Shopping
                </a>
            </p>
        @endif
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
@endsection

@section('scripts')
    <script type="text/javascript"></script>
@endsection
