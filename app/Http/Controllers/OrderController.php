<?php

namespace App\Http\Controllers;

use App\Order;
use App\Cart;
use App\Order_detail;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource; 
use App\Http\Resources\OrderDetailResource; 
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
    	$orders = Order::all();
        return OrderResource::collection($orders);
     //    $order_details = Order_detail::all();
    	// return OrderDetailResource::collection($order_details);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'      => 'required',
            'no_meja'   => 'required|integer',
        ]);

        if($validator->fails()) {

            return response()->json($validator->errors(), 400);
 
        } else {

            $order =  Order::create([
                'nama' => $request->nama,
                'no_meja' => $request->no_meja,
            ]);

            //masukan keranjang ke detail order
            $carts = Cart::all();
            foreach ($carts as $cart) {
                $detail_order = Order_detail::create([
                    'order_id'   => $order->id,
                    'food_id'    => $cart->food_id,
                    'qty'        => $cart->jumlah_pesan,
                    'keterangan' => $cart->keterangan,
                ]);
            }

            //hapus semua data di cart
            Cart::truncate();

            return OrderDetailResource::collection(Order_detail::where('order_id', $order->id));;
        }
    }

    public function show($id)
    {
        $order = Order_detail::where('order_id', $id)->get();
        return OrderDetailResource::collection($order);
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            Order_detail::where('order_id', $id)->delete();
            return response()->json(['message' => 'Data deleted successfully'], 204);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }
}
