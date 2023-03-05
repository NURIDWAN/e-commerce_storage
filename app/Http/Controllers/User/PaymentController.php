<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Invoice;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\OrderItem;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class PaymentController extends Controller
{
    //pembayarean stripe function
    public function PayStripe(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        \Stripe\Stripe::setApiKey('sk_test_51M5mhBLdxOR71fsNZBuJ6kLZTOIph43vl2P7LWRw1PibxVUNBpKyXOHI4jmjRZQDN9rVak5yMHaJ9oxAFWEqholV00YP3VLTPo');

        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
            'amount' => $total_amount * 100,
            'currency' => 'usd',
            'description' => 'Gi Company Store',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);

        // dd($charge);

        // insert data ke tabel order
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'poscode' => $request->poscode,
            'addres' => $request->addres,

            'payment_method' => 'Stripe',
            'transaction_id' => $charge->balance_transaction,
            'amount' => $total_amount,

            'order_number' => $charge->metadata->order_id,
            'invoice_number' => 'ESZ' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'shipping_status' => 'pending',
            'created_at' => Carbon::now(),
        ]);

        // sintakl insert data ke tabel order item
        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'weight' => $cart->weight,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        // email notifiction
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_number' => $invoice->invoice_number,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
        ];

        Mail::to($request->email)->send(new OrderMail($data));

        Cart::destroy();

        $notif = array(
            'message' => 'Terimakasih Pesanan Berhasil Dibuat',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notif);
    }


    // method untuk cod
    public function PaymentCash(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        // sintak inseert data ket tabelorder
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'poscode' => $request->poscode,
            'addres' => $request->addres,

            'payment_method' => 'Cash On Delivery',
            'amount' => $total_amount,

            'order_number' => mt_rand(10000000, 99999999),
            'invoice_number' => 'ESZ' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'shipping_status' => 'pending',
            'created_at' => Carbon::now(),
        ]);

        // insert data kke database order item
        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'weight' => $cart->weight,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        // email notificaton
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_number' => $invoice->invoice_number,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
        ];

        Mail::to($request->email)->send(new OrderMail($data));

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        $notification = array(
            'message' => 'Terima Kasih Pesanan Berhasil Dibuat !',
            'alert-type' => 'success',
        );

        return redirect()->route('dashboard')->with($notification);
    }



    // function pembayaran manual
    public function PaymentManual(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        // sintak inseert data ket tabelorder
        $image = $request->file('bukti_pembayaran');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(500, 637)->save('upload/orders/' . $name_gen);
        $save_url = 'upload/orders/' . $name_gen;

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'poscode' => $request->poscode,
            'addres' => $request->addres,

            'payment_method' => 'Bank Transfer Manual',
            'amount' => $total_amount,
            'bukti_pembayaran' => $save_url,

            'order_number' => mt_rand(10000000, 99999999),
            'invoice_number' => 'ESZ' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'shipping_status' => 'pending',
            'created_at' => Carbon::now(),
        ]);

        // insert data kke database order item
        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'weight' => $cart->weight,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        // email notificaton
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_number' => $invoice->invoice_number,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
        ];

        Mail::to($request->email)->send(new OrderMail($data));

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        $notification = array(
            'message' => 'Terima Kasih Pesanan Berhasil Dibuat !',
            'alert-type' => 'success',
        );

        return redirect()->route('dashboard')->with($notification);
    }
}
