@extends('index')

@section('content')
    <div class="w-6/12 mx-auto bg-white p-5">
        <form action="{{ Request::url() }}" method="post">
            @csrf
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
                <button type="submit" class="w-full button bg-orange-700 hover:bg-orange-900 rounded text-white font-bold">
                    Login
                </button>
            </div>
        </form>
    </div>

    @if ($errors->any())
        <div class="error fixed p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
            role="alert">
            <span class="font-medium">Error</span>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
