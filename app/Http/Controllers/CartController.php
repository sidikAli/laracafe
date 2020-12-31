<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CartResource; 

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::all();
        return CartResource::collection($carts);
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
        //validate data
        $validator = Validator::make($request->all(), [
            'food_id'      => 'required|integer',
            'jumlah_pesan' => 'required|integer',
        ]);

        if($validator->fails()) {

            return response()->json($validator->errors(), 400);
 
        } else {

            $cart = Cart::create([
                'food_id'       => $request->food_id,
                'jumlah_pesan'  => $request->jumlah_pesan,
                'keterangan'    => $request->keterangan
            ]);

            return response()->json(['cart' => $cart], 201);   
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'jumlah_pesan' => 'required|integer',
        ]);

        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        if($validator->fails()) {

            return response()->json($validator->errors(), 400);
 
        } else {

            $data = [
                'jumlah_pesan'  => $request->jumlah_pesan,
                'keterangan'    => $request->keterangan
            ];

            $cart->update($data);

            return response()->json(['cart' => $cart], 200);   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);
        if ($cart) {
            $cart->delete();
            return response()->json(['message' => 'Data deleted successfully'], 204);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }
}
