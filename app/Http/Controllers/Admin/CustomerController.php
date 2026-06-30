<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\StoreCustomerRequest;
use App\Http\Requests\Admin\Customer\UpdateCustomerRequest;
use App\Models\Customer;
use App\Notifications\Admin\CustomerCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Customer::query()->orderBy('name', 'asc');

        $customers = $query->get();

        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
        $validated = $request->validated();

        $customer = Customer::create($validated);

        $customer->notify(new CustomerCreatedNotification($customer));

        return response()->json($customer, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
        $query = Customer::where("id", $customer->id);

        return response()->json($query->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
        $validated = $request->validated();

        $customer->update($validated);

        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->noContent();
    }

    public function toggleActive(Customer $customer)
    {
        $customer->active = !$customer->active;
        $customer->save();

        return response()->json($customer);
    }

    public function sendPasswordReset(Customer $customer)
    {
        Password::broker('customers')->sendResetLink([
            'email' => $customer->email,
        ]);

        return response()->json([
            'message' => 'Password reset email sent.'
        ]);
    }
}
