<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Customer::select('customer_id', 'first_name', 'last_name', 'gold_member', 'address', 'city', 'state', 'points')->get();
        // $results = DB::table('customers')
        // ->join('orders', 'customers.customer_id', '=', 'orders.customer_id')
        // ->join('products', 'orders.product_id', '=', 'products.product_id')
        // ->select('customers.first_name', 'orders.order_date', 'products.product_name')
        // ->get();
        // laravel query builder šitas ir

        return Customer::all();

        $orders = DB::select('SELECT
          c.customer_id, 
          c.first_name,
          c.last_name,
          c.address,
          c.city,
          c.state,
          c.points,
          o.order_date,
          os.name
        FROM
            sql_store.customers c
        JOIN
            sql_store.orders o
        JOIN
            sql_store.order_statuses os
        ON
            c.customer_id = o.customer_id;
        
           ');

        

        return $orders;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    // {
    //     $fields = $request->validate([
    //         'customer_id',
    //         'first_name',
    //         'last_name',
    //         'address',
    //         'city',
    //         'state'
    //     ]);
    //     // $request->validate([
    //     // 'customer_id' => 'required',
    //     // 'first_name',
    //     // 'last_name',
    //     // 'gold_member',
    //     // 'address',
    //     // 'city',
    //     // 'state',
    //     // 'points'
    //     // ]);
    //     $customer = Customer::create($fields);
    //     return [ 'customer' => $customer];
    // }
{
    // Validate the request data
    $fields = $request->validate([
        'customer_id' => 'required|integer', // Example validation rule
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:100',
        'state' => 'required|string|max:100'
    ]);

    // Create the customer using the validated data
    $customer = Customer::create($fields);

    // Return the newly created customer
    return response()->json([
        'customer' => $customer
    ]);
}


    /**
     * Display the specified resource.
     */
    public function show( Customer $customer)
    {
        // // raw sql šitas i
        // $order = DB::select('SELECT 
        // c.customer_id, 
        //   c.first_name,
        //   c.last_name,
        //   c.address,
        //   c.city,
        //   c.state,
        //   c.points,
        //   o.order_date,
        //   os.name
        //   FROM
        //     sql_store.customers c
        // JOIN
        //     sql_store.orders o
        // JOIN
        //     sql_store.order_statuses os
        // ON
        //     c.customer_id = o.customer_id
        // WHERE
        //     c.customer_id = ?
        
        // ', [$customer->customer_id]);
        
        
        // return $order;

        //Šitas i laravel query builder
        $results = DB::table('customers as c')
            ->join('orders as o', 'c.customer_id', '=', 'o.customer_id')
            ->join('order_statuses as os', 'o.status', '=', 'os.order_status_id')
            ->select(
                'c.customer_id',
                'c.first_name',
                'c.last_name',
                'c.address',
                'c.city',
                'c.state',
                'c.points',
                'o.order_date',
                'os.name as order_status_name'
            )
            ->where('c.customer_id', '=', [$customer->customer_id]
            )
            ->toSql();

            return $results;


        // return [
        //     'customer_id' => $customer->customer_id,
        //     'first_name' => $customer->first_name,
        //     'last_name' => $customer->last_name,
        //     'gold_member' => $customer->isGoldMember(),
        //     'address' => $customer->adress,
        //     'city' => $customer->city,
        //     'state' => $customer->state,
        //     'points' => $customer->points
        // ];
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $post->update($fields);
        return [ 'customer' => $customer];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return [ 'message' => 'The customer was deleted'];
    }
}
