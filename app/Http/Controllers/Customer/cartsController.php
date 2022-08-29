<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class cartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Transaction::with('product')
            ->where('user_id', Auth::user()->id)
            ->select('*', DB::raw("sum(quantity) as qty"))
            ->groupBy('product_id')
            ->where('status', 'unpaid')
            ->with("product")
            ->get();

        $jumlah_cart = $carts->sum('qty');
        if ($jumlah_cart > 99) {
            $jumlah_cart = "99+";
        }
        $total_harga = 0;
        foreach ($carts as $cart) {
            // $total_harga += $cart->qty * $cart->product->price;
            $total_harga += $cart->product->price * $cart->quantity;
        }
        return view('customer.carts', compact('carts', 'jumlah_cart', 'total_harga'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $transaction = Transaction::where('product_id', $product->id)
            ->where('status', '=', 'unpaid')
            ->get();

        foreach ($transaction as $transaksi) {
            if ($transaksi) {
                $stock = Stock::where('product_id', $transaksi->product_id)->first();
                $stock->update([
                    'quantity' => $transaksi->quantity + $stock->quantity
                ]);
                $transaksi->delete();
            } else {
                $tes = Transaction::where('product_id', $transaksi->product_id)
                    ->where('status', '!=', 'unpaid');
                $tes->delete();
            }
        }
        return redirect()->back();
    }
}
