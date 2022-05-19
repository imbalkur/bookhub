<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request) {
        $data = $request->session()->all();
        $carts = Cart::where('user_id', '=', Auth::id())->get();
        $books = Books::all();
        return view('cart', [
            'data' => $data,
            'carts' => $carts,
            'books' => $books
        ]);
    }

     public function addtocart($id) {
        $book = Books::find($id);

        if (Auth::id()) {
            $cart = Cart::where([['user_id' ,'=', Auth::id()], ['book_id', '=', $book->id]])->first();
            if ($cart) {
                $cart->quantity++;
                $cart->save();
            }
            else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'book_id' => $book->id,
                    'quantity' => 1
                ]); 
            }
            
        }
        else {
            $cart = session()->get('cart', []);
    
            if(isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    "id" => $book->id,
                    "name" => $book->name,
                    "price" => $book->price,
                    "author" => $book->author,
                    "image" => $book->cover_image,
                    "quantity" => 1,
                    "is_checked" => "true"
                ];
            }
            session()->put('cart', $cart);
        }
        return redirect()->back()->withSuccess('Product added to cart successfully!');
    }

    public function updateCart(Request $request) {
        if($request->id && $request->quantity){
            if (Auth::id()) {
                $cart = Cart::findorfail($request->id);
                $cart->quantity = $request->quantity;
                $cart->save();
                return redirect()->back()->withSuccess('Cart updated successfully');
            }
            else {
                $cart = session()->get('cart');
                $cart[$request->id]["quantity"] = $request->quantity;
                session()->put('cart', $cart);
                // session()->flash('success', 'Cart updated successfully');
                return redirect()->back()->withSuccess('Cart updated successfully');
            }
        }

        if($request->id && $request->check) {
            if (Auth::id()) {
                $cart = Cart::findorfail($request->id);
                $is_checked = $request->is_checked === 'true' ? 1 : 0; 
                $cart->is_checked = $is_checked;
                $cart->save();
                return redirect()->back()->withSuccess('Cart updated successfully');
            }
            else {
                $cart = session()->get('cart');
                // return redirect(('/'));
                $cart[$request->id]["is_checked"] = $request->is_checked;
                session()->put('cart', $cart);
                // session()->flash('success', 'Cart updated successfully');
                return redirect()->back();
            }
        }
    }

    public function removeFromCart($id) {
        if($id) {
            if (Auth::id()) {
                $cart = Cart::find($id)->delete();
                return redirect()->back()->withSuccess('Product removed from cart successfully!');
            }
            else{
                $cart = session()->get('cart');
                if(isset($cart[$id])) {
                    unset($cart[$id]);
                    session()->put('cart', $cart);
                }
            }
            return redirect()->back()->withSuccess('Product removed from cart successfully!');
        }
    }
        
    
}
