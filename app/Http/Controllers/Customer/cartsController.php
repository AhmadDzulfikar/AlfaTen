<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
    }

    public function editQty(Request $request)
    {

        $check = Transaction::where("product_id", $request->product_id)->where("user_id", Auth::user()->id)->where("status", "unpaid")->with("product.discountS")->first();

        if ($check !== null) {
            Transaction::find($check->id)->update([
                "quantity" => $request->quantity
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil Menambahkan produk kedalam Carts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaction::find($id)->delete();
        return redirect()->back();
    }

    public function generateInvoice()
    {
        $invoice_code = "INV_" . Auth::user()->id . Str::random(5);

        $check = Transaction::where("invoice_code", $invoice_code)->get();

        if (count($check) > 0) { //Invoice sudah dipakai
            $invoice_code = $this->generateInvoice();
        }

        return $invoice_code;
    }

    public function checkout()
    {
        $invoice_code = $this->generateInvoice();

        Transaction::where("user_id", Auth::user()->id)->where("status", "unpaid")->update([
            "status" => "waiting",
            "invoice_code" => $invoice_code
        ]);

        return redirect()->route('customer.invoice', $invoice_code);
    }

    public function invoice($invoice_code)
    {
        $carts = Transaction::where('user_id', Auth::user()->id)
            ->where("status", "unpaid")
            ->with("product")
            ->get();

        $jumlah_cart = $carts->sum('quantity');

        $transactions = Transaction::where("invoice_code", $invoice_code)->get();

        return view('customer.invoice', compact("transactions", "jumlah_cart"));
    }
}
