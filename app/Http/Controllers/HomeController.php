<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $books = Books::orderBy('created_at', 'desc')->paginate(8);
        // $user_id = User::find($id);
        session()->put('user_id', Auth::id());
        return view('home', [
            'books' => $books
        ]);
    }
}
