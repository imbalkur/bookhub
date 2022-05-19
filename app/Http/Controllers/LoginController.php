<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login() {
        return view('user.login');
    }

    public function loginCart() {
        return view('user.login');
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email','password'), $request->remember)) {
            return back()->withErrors('Invalid login attempt');
        }

        // $request->session()->forget('cart');
        return redirect()->route('home');
    }

    public function storeCart(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email','password'), $request->remember)) {
            return back()->withErrors('Invalid login attempt');
        }

        $cartsSession = session()->get('cart', []);
        foreach($cartsSession as $book) {
            $cart = Cart::where([['user_id' ,'=', Auth::id()], ['book_id', '=', $book['id']]])->first();
            if ($book['is_checked'] === 'true') {
                if ($cart) {
                    $cart->quantity++;
                    $cart->save();
                }
                else {
                    Cart::create([
                        'user_id' => Auth::id(),
                        'book_id' => $book['id'],
                        'quantity' => $book['quantity']
                    ]); 
                }
            }
            
        }

        $request->session()->forget('cart');
        return redirect()->route('confirm-order');
    }
}
