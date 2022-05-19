<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BookHub</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</head>

<body>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <nav class="navbar flex bg-white justify-between items-center p-5 shadow-[0_15px_10px_-15px_rgba(0,0,0,0.3)] ">
        <div>
            <a href="/" class="font-bold text-4xl text-orange-800 hover:text-orange-900">BookHub</a>
        </div>

        <div class="">
            <a href="/" class="mx-3 font-medium text-gray-500 hover:text-gray-900">Home</a>

            <a href="{{ route('books') }}" class="mx-3 font-medium text-gray-500 hover:text-gray-900">Books</a>

            <a href="#" class="mx-3 font-medium text-gray-500 hover:text-gray-900">About Us</a>

            <a href="#" class="mx-3 font-medium text-gray-500 hover:text-gray-900">Contact Us</a>

            <a href="{{ route('cart') }}"
                class="mx-3 font-medium text-orange-700 hover:text-orange-500 hover:text-gray-900">Cart</a>


            @auth
                <div class="dropdown admin">
                    <button onclick="addBookDropdown()"
                        class="dropbtn mx-3 font-medium text-blue-500 hover:text-blue-900">Admin</button>
                    <div id="addbook" class="dropdown-content">
                        <a href="/addbook" class="font-medium text-gray-500 hover:text-orange-900 hover:bg-orange-100">Add
                            Book</a>
                    </div>
                </div>

                <div class="dropdown account">
                    <button onclick="userDropdown()"
                        class="dropbtn mx-3 font-medium text-orange-700 hover:text-orange-900">{{ Auth::user()->name }}</button>
                    <div id="myorder" class="dropdown-content">
                        <a href="{{ route('myorder') }}"
                            class="font-medium text-gray-700 hover:text-orange-900 hover:bg-orange-100">My
                            Order</a>
                    </div>
                </div>



                <a href="{{ route('logout') }}" class="mx-3 font-medium text-orange-900 hover:text-orange-500">Log Out</a>
            @endauth

            @guest
                <a href="{{ route('register') }}"
                    class="mx-3 font-medium text-orange-700 hover:text-orange-500">Register</a>

                <a href="{{ route('login') }}" class="mx-3 font-medium text-orange-700 hover:text-orange-500">Log in</a>
            @endguest
        </div>
    </nav>

    <div class="py-5 bg-slate-50 min-h-screen w-full">
        <div class="body-content">
            @yield('content')
        </div>
    </div>
    @yield('scripts')


    <footer>
        <div class="bg-black text-white p-5">
            <div class="flex justify-between container mx-auto">
                <div>
                    <a href="/" class="font-bold text-4xl text-orange-700 hover:text-orange-700 my-5">BookHub</a>
                    <p>Buy Books at affordable prices</p>
                </div>
                <div class="flex flex-col">
                    <h1 class="text-xl">Quick Links</h1>
                    <a href="/" class="font-medium text-gray-500 hover:text-gray-100">Home</a>
                    <a href="#" class="font-medium text-gray-500 hover:text-gray-100">Books</a>
                    <a href="#" class="font-medium text-gray-500 hover:text-gray-100">About Us</a>
                    <a href="#" class="font-medium text-gray-500 hover:text-gray-100">Contact Us</a>
                    <a href="{{ route('cart') }}" class="font-medium text-gray-500 hover:text-gray-100">Cart</a>
                </div>
                <div>
                    <a href="#" class="font-medium text-gray-500 hover:text-gray-100">Books</a>
                </div>
            </div>

        </div>
    </footer>
</body>

</html>
