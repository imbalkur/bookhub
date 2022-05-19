<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyOrderController extends Controller
{
    public function index() {
         $orders = Order::where('user_id' ,'=', Auth::id())->get();
         $books = Books::all();
        return view('myorder', [
            'orders' => $orders,
            'books' => $books
        ]);
    }

    public function deleteOrder() {
        $orders = Order::where('user_id' ,'=', Auth::id())->get();
        foreach($orders as $order) {
            $order->delete();
        }

        return redirect('/')->withSuccess('Order Cancelled Successfully');
    }
}
