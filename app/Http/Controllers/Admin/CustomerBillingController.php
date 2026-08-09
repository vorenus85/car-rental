<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\CustomerBillingRequest;
use App\Models\Customer;
use App\Models\CustomerBillingInfo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerBillingController extends Controller
{

    //
    public function update(
        CustomerBillingRequest $request,
        Customer $customer
    ): JsonResponse {
        $billingInfo = $customer->billingInfo()->updateOrCreate(
            [],
            $request->validated()
        );

        return response()->json($billingInfo);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): JsonResponse
    {
        return response()->json(
            $customer->billingInfo
        );
    }
}
