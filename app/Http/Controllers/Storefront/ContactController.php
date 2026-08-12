<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storefront\ContactFormRequest;
use App\Notifications\Storefront\ContactMessageNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function store(ContactFormRequest $request): JsonResponse
    {
        $validated = $request->validated();

        Notification::route('mail', config('services.contact.email'))
            ->notify(new ContactMessageNotification($validated));

        return response()->json([
            'message' => 'Thanks! Your message has been sent.',
        ]);
    }
}
