<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //method unntuk menampilkan halaman transaksi yg ditunda
    public function PendingOrders()
    {
        $orders = Order::where('shipping_status', 'pending')->orderBy('id', 'desc')->get();
        return view('backend.orders.pending-orders', compact('orders'));
    }

    // method ntuk menampilkan halaman lihat detail transaksi yang ditunda
    public function PendingOrdersDetails($order_id)
    {
        $order = Order::with('province', 'city', 'district', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'desc')->get();
        return view('backend.orders.pending-orders-details', compact('order', 'orderItem'));
    }

    // method untuk proses menampilkan konfirmassi pesanan
    public function ConfirmedOrders()
    {
        $orders = Order::where('shipping_status', 'di konfirmasi')->orderBy('id', 'desc')->get();
        return view('backend.orders.confirmed-orders', compact('orders'));
    }

    public function PendingToConfirm($order_id)
    {
        Order::findOrFail($order_id)->update(['shipping_status' => 'Di Konfirmasi']);

        $notif = array(
            'message' => 'Pesanan Berhasil Di Konfirmasi',
            'alert-type' => 'success'
        );

        return redirect()->route('pending.orders')->with($notif);
    }

    public function PickedOrders()
    {
        $orders = Order::where('shipping_status', 'Dikemas')->orderBy('id', 'DESC')->get();
        return view('backend.orders.picked-orders', compact('orders'));
    }

    public function ConfirmToPicked($order_id)
    {
        Order::findOrFail($order_id)->update(['shipping_status' => 'Dikemas']);

        $notif = array(
            'message' => 'Pesanan Berhasil Dikemas',
            'alert-type' => 'success'
        );

        return redirect()->route('picked.orders')->with($notif);
    }

    public function ShippedOrders()
    {
        $orders = Order::where('shipping_status', 'Dikirim')->orderBy('id', 'DESC')->get();
        return view('backend.orders.shipped-orders', compact('orders'));
    }

    public function PickedToShipped($order_id)
    {
        Order::findOrFail($order_id)->update(['shipping_status' => 'Dikirim']);

        $notif = array(
            'message' => 'Pesanan Berhasil Dikirim',
            'alert-type' => 'success'
        );

        return redirect()->route('picked.orders')->with($notif);
    }

    public function OnTheWayOrders()
    {
        $orders = Order::where('shipping_status', 'Dalam Perjalanan')->orderBy('id', 'DESC')->get();
        return view('backend.orders.otw-orders', compact('orders'));
    }

    public function ShippedToOtw($order_id)
    {
        Order::findOrFail($order_id)->update(['shipping_status' => 'Dalam Perjalanan']);

        $notif = array(
            'message' => 'Pesanan Berhasil Dalam Perjalanan',
            'alert-type' => 'success'
        );

        return redirect()->route('shipped.orders')->with($notif);
    }

    public function DeliveredOrders()
    {
        $orders = Order::where('shipping_status', 'selesai')->orderBy('id', 'DESC')->get();
        return view('backend.orders.delivered-orders', compact('orders'));
    }

    public function OtwToDelivered($order_id)
    {
        $product = OrderItem::where('order_id', $order_id)->get();

        // syntak mengurangi kuantitas produk
        foreach ($product as $item) {
            Product::where('id', $item->product_id)->update(
                ['product_qty' => DB::raw('product_qty-'.$item->qty)]
            );
        }

        Order::findOrFail($order_id)->update(['shipping_status' => 'selesai']);

        $notif = array(
            'message' => 'Pesanan Sudah Diterima',
            'alert-type' => 'success'
        );

        return redirect()->route('otw.orders')->with($notif);
    }

    public function CancelRequest()
    {
        $orders = Order::where('cancel_order', 1)->orderBy('id','DESC')->get();
        return view('backend.orders.cancel-request', compact('orders'));
    }

    public function CancelRequestApprove($order_id)
    {
        Order::where('id', $order_id)->update(['cancel_order' => 2]);

        $notif = array(
            'message' => 'Pembatalan Berhasil Dikonfirmasi',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notif);
    }

    public function CancelAllRequest()
    {
        $orders = Order::where('cancel_order', 2)->orderBy('id', 'DESC')->get();
        return view('backend.orders.cancel-all-request', compact('orders'));
    }

    public function ReturnRequest()
    {
        $orders = Order::where('return_order', 1)->orderBy('id', 'DESC')->get();
        return view('backend.orders.return-request', compact('orders'));
    }

    public function ReturnRequestApprove($order_id)
    {
        Order::where('id', $order_id)->update(['return_order' => 2]);

        $notif = array(
            'message' => 'Pengembalian Berhasil Dikonfirmasi',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notif);
    }
    
    public function ReturnAllRequest()
    {
        $orders = Order::where('return_order', 2)->orderBy('id', 'DESC')->get();
        return view('backend.orders.return-all-request', compact('orders'));
    }
}
