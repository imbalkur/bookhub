<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class AddBookController extends Controller
{
    public function index()
    {
        return view('addbook');
    }

    public function store(Request $request) {
        $request->validate([
           'name' => 'required',
           'author' => 'required',
           'pages' => 'required',
           'price' => 'required',
           'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imageName = time().'.'.$request->cover_image->extension();  
        $request->cover_image->move(public_path('images'), $imageName);

        Books::create([
            'name' => $request->name,
            'author' => $request->author,
            'cover_image' => $imageName,
            'num_pages' => $request->pages,
            'price' => $request->price
        ]);

        return redirect()->route('addbook');
    }
}
