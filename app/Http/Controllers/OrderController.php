<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Customer $customer)
    {
        // // $orders = Order::where('order_id', $customer_id)->get();
        // $c = Customer::find($customer_id);
        // $orders = $c->orders()
        // ->select('orders.*', 'order_statuses.name as status_name')
        // ->join('order_statuses', 'orders.status_id', '=', 'order_statuses.id')
        // ->get();
        // return $order;
        // // return $c;
        return $customer->orders;

        $orders = DB::select('SELECT
          o.order_id, 
          o.customer_id,
          o.order_date,
          o.status,
          o.comments,
          o.shipped_date,
          o.shipper_id,
          os.name AS status_name
          os.name
        FROM
            sql_store.orders o
        JOIN
            order_statuses os ON o.status = os.order_status_id
        
        ');

        return response()->json($orders);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $customer_id, $order_id)
    {
        $order = DB::table('orders')
        ->where('customer_id', '=', $customer_id)
        ->where('order_id', '=', $order_id)
        ->first();

        if ($order) {
            return response()->json(["message" => "Order not found"]);
        }

        return response()->json($order);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
