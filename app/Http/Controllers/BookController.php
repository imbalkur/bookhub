<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $books = Books::orderBy('created_at', 'desc')->get();
        return view('book', [
            'books' => $books
        ]);
    }
}
