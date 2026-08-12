<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storefront\ContactFormRequest;
use App\Mail\Storefront\ContactMessageMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(ContactFormRequest $request): JsonResponse
    {
        $validated = $request->validated();

        Mail::to(config('services.contact.email'))
            ->send(new ContactMessageMail($validated));

        return response()->json([
            'message' => 'Thanks! Your message has been sent.',
        ]);
    }
}
