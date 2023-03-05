<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\PDF;

class AllUserController extends Controller
{
    //functionuntuk menampilkan halaman transasi di order
    public function MyOrders()
    {
        $orders =   Order::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('frontend.user.order-view', compact('orders'));
    }

    // menampilkan halaman etail transaksi
    public function OrderDetails($order_id)
    {
        $order = Order::with('province', 'city', 'district', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'desc')->get();
        return view('frontend.user.order-details', compact('order', 'orderItem'));
    }

    // function untuk mendownload pdf
    public function InvoiceDownload($order_id)
    {
        $order = Order::with('province', 'city', 'district', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'desc')->get();
        // return view('frontend.user.order-invoice', compact('order', 'orderItem'));

        $pdf = PDF::loadView('frontend.user.order-invoice', compact('order', 'orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);

        return $pdf->download('invoice.pdf');
    }

    public function CancelOrder(Request $request, $order_id)
    {
        Order::findOrFail($order_id)->update([
            'cancel_date' => Carbon::now()->format('d F Y'),
            'cancel_reason' => $request->cancel_reason,
            'cancel_order' => 1,
        ]);

        $notif = array(
            'message' => 'Permintaan Pembatalan Berhasil Terkirim',
            'alert-type' => 'success'
        );

        return redirect()->route('my.orders')->with($notif);
    }

    public function CancelOrderList()
    {
        $orders = Order::where('user_id', Auth::id())->where('cancel_reason', '!=', NULL)->orderBy('id', 'DESC')->get();
        return view('frontend.user.cancel-order-view', compact('orders'));
    }

    public function ReturnOrder(Request $request, $order_id)
    {
        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1,
        ]);

        $notif = array(
            'message' => 'Permintaan Pembatalan Berhasil Terkirim',
            'alert-type' => 'success'
        );

        return redirect()->route('my.orders')->with($notif);
    }

    public function ReturnOrderList()
    {
        $orders = Order::where('user_id', Auth::id())->where('return_reason', '!=', NULL)->orderBy('id', 'DESC')->get();
        return view('frontend.user.return-order-view', compact('orders'));
    }
}
