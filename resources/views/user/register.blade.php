@extends('index')

@section('content')
    <div class="w-6/12 mx-auto bg-white p-5">
        <form action="{{ route('store') }}" method="post">
            @csrf
            <div class="my-2 p-3">
                <label for="name" class="font-bold">Username</label>
                <input type="text" class="rounded mt-2 p-2 border-2 border-slate-300 text-pink-500 w-full" name="name"
                    id="name" value="{{ old('name') }}" />
                @error('name')
                    <div class=" text-red-500">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="my-2 p-3">
                <label for="email" class="font-bold">Email</label>
                <input type="email" class="rounded mt-2 p-2 border-2 border-slate-300 text-pink-500 w-full" name="email"
                    id="email" value="{{ old('email') }}" />
                @error('email')
                    <div class="text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="my-2 p-3">
                <label for="password" class="font-bold">Password</label>
                <input type="password"
                    class="rounded mt-2 p-2 border-2 border-slate-300 text-pink-500 w-full @error('password') border-red-500 @enderror"
                    name="password" id="password" value="{{ old('password') }}" />
                @error('password')
                    <div class="  text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="my-2 p-3">
                <label for="password_confirmation" class="font-bold">Confirm Password</label>
                <input type="password"
                    class="rounded mt-2 p-2 border-2 border-slate-300 text-pink-500 w-full @error('confirm-password') border-red-500 @enderror"
                    name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" />
            </div>
            <div class="my-2 p-3">
                <button type="submit" class="w-full button bg-orange-700 hover:bg-orange-900 rounded text-white font-bold">
                    Register
                </button>
            </div>
        </form>
    </div>
@endsection
