<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Customer::select('customer_id', 'first_name', 'last_name', 'gold_member', 'address', 'city', 'state', 'points')->get();
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
    public function show(Customer $customer)
    {
        return [
            'customer_id' => $customer->customer_id,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'gold_member' => $customer->isGoldMember(),
            'address' => $customer->adress,
            'city' => $customer->city,
            'state' => $customer->state,
            'points' => $customer->points
        ];
       
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
