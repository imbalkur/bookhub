<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Books;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfirmOrderController extends Controller
{
    public function index()
    {
        $carts = Cart::where([['user_id', '=', Auth::id()], ['is_checked', '=', '1']])->get();
        $address = Address::where('user_id', '=', Auth::id())->first();
        $books = Books::all();
        return view('confirmOrder', [
            'carts' => $carts,
            'books' => $books,
            'address' => $address
        ]);
    }

    public function saveAddress(Request $request)
    {
        $address = Address::where('user_id', '=', Auth::id())->first();
        if (!$address) {
            $request->validate([
                'address' => 'required',
                'city' => 'required',
                'pincode' => 'required'
            ]);

            Address::create([
                'user_id' => Auth::id(),
                'address' => request()->address,
                'city' => request()->city,
                'pincode' => request()->pincode
            ]);
        }
        else {
            $request->validate([
                'address' => 'required',
                'city' => 'required',
                'pincode' => 'required'
            ]);

            $address->address = request()->address;
            $address->city = request()->city;
            $address->pincode = request()->pincode;
            $address->save();
        }

        return redirect()->back()->withSuccess('Address saved successfully');
    }

    public function confirmOrder()
    {
        $carts = Cart::where([['user_id', '=', Auth::id()], ['is_checked', '=', '1']])->get();
        
        foreach($carts as $cart) {
            Order::create([
                'user_id' => Auth::id(),
                'book_id' => $cart->book_id,
                'quantity' => $cart->quantity
            ]);

            $cart->delete();
        }

        return redirect('/')->withSuccess('Order Confirmed');
    }
}
