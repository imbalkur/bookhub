@extends('index')

@section('content')
    <div class="w-6/12 mx-auto bg-white p-5">
        <form action="{{ route('addbook') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="my-2 p-3">
                <label for="name" class="font-bold">Book Name</label>
                <input type="name" class="rounded mt-2 p-2 border-2 border-slate-300 text-pink-500 w-full" name="name"
                    id="name" value="{{ old('name') }}" />
                @error('name')
                    <div class="text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="my-2 p-3">
                <label for="author" class="font-bold">Author Name</label>
                <input type="text" class="rounded mt-2 p-2 border-2 border-slate-300 text-pink-500 w-full" name="author"
                    id="author" value="{{ old('author') }}" />
                @error('author')
                    <div class="text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="my-2 p-3">
                <label for="cover_image" class="font-bold">Cover Image</label>
                <input type="file" class="rounded mt-2 p-2 border-2 border-slate-300 text-pink-500 w-full"
                    name="cover_image" id="cover_image" value="{{ old('cover_image') }}" />
                @error('cover_image')
                    <div class="text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="my-2 p-3 w-12/12 flex items-center justify-between">
                <div>
                    <label for="pages" class="font-bold">No. of pages</label>
                    <input type="number" class="rounded mt-2 p-2 border-2 border-slate-300 text-pink-500" name="pages"
                        id="pages" value="{{ old('pages') }}" />
                    @error('pages')
                        <div class="  text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="price" class="font-bold">Price</label>
                    <input type="number" class="rounded mt-2 p-2 border-2 border-slate-300 text-pink-500" name="price"
                        id="price" value="{{ old('price') }}" />
                    @error('price')
                        <div class="  text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="my-2 p-3">
                <button type="submit" class="w-full button bg-orange-700 hover:bg-orange-900 rounded text-white font-bold">
                    Add Book
                </button>
            </div>
        </form>

        @if ($errors->any())
            <div class="error absolute p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
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
