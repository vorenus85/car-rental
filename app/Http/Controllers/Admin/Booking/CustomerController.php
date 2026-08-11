<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\StoreCustomerRequest;
use App\Http\Requests\Admin\Customer\UpdateCustomerRequest;
use App\Http\Resources\Admin\CustomerResource;
use App\Models\Booking\Customer;
use App\Notifications\Admin\CustomerCreatedNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        $query = Customer::query()->orderBy('last_name', 'asc');

        $customers = $query->get();

        return response()->json(CustomerResource::collection($customers));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request): JsonResponse
    {
        //
        $validated = $request->validated();

        $customer = Customer::create($validated);

        $customer->notify(new CustomerCreatedNotification($customer));

        return response()->json(new CustomerResource($customer), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): JsonResponse
    {
        //
        return response()->json(new CustomerResource($customer));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer): JsonResponse
    {
        //
        $validated = $request->validated();

        $customer->update($validated);

        return response()->json(new CustomerResource($customer));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): Response
    {
        $customer->delete();

        return response()->noContent();
    }

    public function toggleActive(Customer $customer): JsonResponse
    {
        $customer->active = ! $customer->active;
        $customer->save();

        return response()->json(new CustomerResource($customer));
    }

    public function sendPasswordReset(Customer $customer): JsonResponse
    {
        Password::broker('customers')->sendResetLink([
            'email' => $customer->email,
        ]);

        return response()->json([
            'message' => 'Password reset email sent.',
        ]);
    }
}
