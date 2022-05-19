@extends('index')

@section('content')
    <h1 class="text-red-800 text-3xl font-bold text-center my-5">Confirm order</h1>
    <hr>
    <div class="flex my-5">
        @php
            $total = 0;
            $quantity = 0;
        @endphp
        @foreach ($carts as $cart)
            @php
                $book_item = $books->find($cart->book_id);
                $total += $cart->quantity * $book_item->price;
                $quantity += $cart->quantity;
            @endphp
            <div class="flex w-3/12 border m-5 p-5 bg-green-100 rounded">
                <div>
                    <h1 class="font-bold ">{{ $book_item->name }}</h1>
                    <h3 class="text-red-500">{{ $book_item->author }}</h3>
                    <div class="flex justify-between">
                        <p>₹ {{ $book_item->price }}</p>
                        <input type="number" data-id={{ $cart['id'] }} value="{{ $cart['quantity'] }}"
                            class="update-cart" name="quantity" min=1 max=10>
                    </div>
                    <br>
                    <button class="button bg-red-500 text-white rounded checkRemove"
                        data-id={{ $cart['id'] }}>Remove</button>
                </div>
            </div>
        @endforeach
    </div>
    <hr>
    <div>
        <div class="flex p-5">
            <div class="w-6/12 p-5">
                <h1 class="font-bold text-xl text-red-700 text-center">Address</h1>
                <form action="{{ route('confirm-address') }}" method="POST">
                    @php
                        $addval = '';
                        $city = '';
                        $pincode = '';
                        if ($address) {
                            $addval = $address['address'];
                            $city = $address['city'];
                            $pincode = $address['pincode'];
                        }
                    @endphp
                    @csrf
                    <div class="my-5">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="w-full p-3 rounded border"
                            value="{{ $addval }}">
                    </div>
                    <div class="my-5">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" class="w-full p-3 rounded border"
                            value="{{ $city }}">
                    </div>

                    <div class="my-5">
                        <label for="pincode">Pincode</label>
                        <input type="number" name="pincode" id="pincode" min="100000" max='999999'
                            class="w-full p-3 rounded border" value="{{ $pincode }}">
                    </div>

                    <button type="submit" class="button bg-yellow-300 rounded">Confirm Address</button>
                </form>
            </div>
            <div class="w-6/12">
                <h1 class="font-bold text-xl text-red-700 text-center">Payment Mode</h1>
                <div class="p-5 bg-blue-100 my-5">
                    <input type="radio" name="" id="" value="" checked> Cash on delevery <br>
                </div>
                <div class="p-5 bg-gray-300 my-5">
                    <input type="radio" name="" id="" value="" disabled> PayPal
                </div>
                <br>
                <div class="bg-blue-100 rounded p-3">
                    <div class="text-center"><span class="text-2xl"> Total</span> <span
                            class="font-bold text-3xl mx-3">₹
                            {{ $total }}
                        </span> (<span>{{ $quantity }} Items</span>)
                    </div>
                    <form action="{{ route('confirm-done') }}" method="POST">
                        @csrf
                        <button type="submit" class="button bg-blue-500 text-white font-bold text-xl w-full rounded my-5">
                            Confirm Order
                        </button>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection
