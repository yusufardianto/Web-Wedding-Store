<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Transaction;
use App\Http\Requests\Admin\DateRequest;
use App\Models\TransactionDetail;

use Exception;

use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends Controller
{
    // public $rental_date = '';

    public function process(Request $request)
    {

        // Save User Data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // Proses Checkout
        $code = 'STORE-' . mt_rand(000000, 999999);
        $carts = Cart::with(['product', 'user'])
            ->where('users_id', Auth::user()->id)
            ->get();


        // Transaction Create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'inscurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(000000, 9999999);
            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'rental_date' => $request->rental_date,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx
            ]);
        }
        // dd($request->all());

        //Delete Cart data
        Cart::where('users_id', Auth::user()->id)->delete();

        // Konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat Array untuk dikirim ke midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'enabled_payments' => [
                'gopay', 'permata_va', 'bank_transfer'
            ],
            'vtweb' => []
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function callback(Request $request)
    {
    }
    // public function store(Request $request)
    // {
    //     $data = $request->all();
    //     $data = $request->input('rental_date');
    //     // $data['rental_date'] = $request->file('rental_date')->store('assets/product', 'public');

    //     TransactionDetail::create($data);


    //     // return TransactionDetail::create([
    //     // ]);
    //     return redirect()->route('cart.index');
    // }

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('cart');
    }

    public function check(Request $request)
    {
        // $data = TransactionDetail::where('products_id', $request->products_id)->orwhere('rental_date', $request->rental_date)->first();
        // $data2 = null;
        // if ($data) {
        //     $data2 = 'Unavailable';
        // } else {
        //     $data2 = 'Available';
        // }
        // return $data2;
        return TransactionDetail::where('products_id', $request->products_id)->where('rental_date', $request->rental_date)->count() > 0 ? 'Unavailable' : 'Available';
        // $posts = 
        // return response([
        //     'success' => true,
        //     'message' => 'List Semua Posts',
        //     'data' => $posts
        // ], 200);
    }
}
