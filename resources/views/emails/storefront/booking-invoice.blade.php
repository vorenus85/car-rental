<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Invoice</title>
</head>
<body style="margin:0; padding:0; background:#f5f7fb; font-family:Arial, Helvetica, sans-serif; color:#1f2937;">
    <div style="max-width:720px; margin:0 auto; padding:32px 16px;">
        <div style="background:#ffffff; border-radius:0; overflow:hidden; box-shadow:0 10px 30px rgba(15, 23, 42, 0.08);">
            <div style="padding:24px 28px; background:linear-gradient(135deg, #111827 0%, #334155 100%); color:#fff;">
                <div style="font-size:14px; opacity:0.85; letter-spacing:0.08em; text-transform:uppercase;">Booking invoice</div>
                <h1 style="margin:8px 0 0; font-size:28px; line-height:1.2;">{{ $booking->booking_number }}</h1>

                <p style="margin:8px 0 0; font-size:16px; opacity:0.9;">Hi {{ $booking->customer?->first_name }} {{ $booking->customer?->last_name }},</p>
                <p style="margin:8px 0 0; font-size:16px; opacity:0.9;"></p>
                <p style="margin:8px 0 0; font-size:16px; opacity:0.9;">Thank you for choosing us. Your car rental booking has been confirmed.</p>
                <p style="margin:8px 0 0; font-size:16px; opacity:0.9;">Below you will find your booking details and invoice, including the vehicle, rental period, pick-up and drop-off locations, insurance, and selected extras.</p>
                <p style="margin:8px 0 0; font-size:16px; opacity:0.9;">Please review the details and contact us if you notice anything incorrect or if you have any questions before your rental.</p>
                <p style="margin:8px 0 0; font-size:16px; opacity:0.9;">We look forward to welcoming you!</p>
                <p style="margin:8px 0 0; font-size:16px; opacity:0.9;"></p>
                <p style="margin:8px 0 0; font-size:16px; opacity:0.9;">
                Best regards,<br/>
                Car Rental Team</p>
            </div>

            <div style="padding:28px;">
                <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:24px;">
                    <tr>
                        <td style="vertical-align:top; width:38%; padding-right:20px;">
                            <img
                                src="{{ $carImageUrl }}"
                                alt="{{ $booking->car?->variant?->model?->brand?->name }} {{ $booking->car?->variant?->model?->name }}"
                                style="display:block; width:100%; max-width:260px; height:auto; border-radius:14px; object-fit:cover; background:#e5e7eb;"
                            >
                        </td>
                        <td style="vertical-align:top;">
                            <h2 style="margin:0 0 8px; font-size:22px; color:#111827;">
                                {{ $booking->car?->variant?->model?->brand?->name }} {{ $booking->car?->variant?->model?->name }}
                            </h2>
                            <p style="margin:0 0 16px; color:#6b7280;">{{ $booking->car?->variant?->name }}</p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;">
                                <tr>
                                    <td style="padding:6px 0; color:#6b7280; width:180px;">Customer</td>
                                    <td style="padding:6px 0; font-weight:600;">{{ $booking->customer?->first_name }} {{ $booking->customer?->last_name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:6px 0; color:#6b7280;">Pick-up at</td>

                                    <td style="padding:6px 0; font-weight:600;">{{ $booking->pickup_at?->setTimezone('Europe/Budapest')->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:6px 0; color:#6b7280;">Pick-up location</td>
                                    <td style="padding:6px 0; font-weight:600;">
                                        {{ $booking->pickupLocation?->name }}
                                        @if($booking->pickupLocation?->city)
                                            , {{ $booking->pickupLocation?->city }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:6px 0; color:#6b7280;">Drop-off at</td>
                                    <td style="padding:6px 0; font-weight:600;">{{ $booking->dropoff_at?->setTimezone('Europe/Budapest')->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:6px 0; color:#6b7280;">Drop-off location</td>
                                    <td style="padding:6px 0; font-weight:600;">
                                        {{ $booking->dropoffLocation?->name }}
                                        @if($booking->dropoffLocation?->city)
                                            , {{ $booking->dropoffLocation?->city }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:6px 0; color:#6b7280;">Days of rent</td>
                                    <td style="padding:6px 0; font-weight:600;">{{ $booking->days }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <div style="margin-top:10px;">
                    <h3 style="margin:0 0 12px; font-size:18px; color:#111827;">Insurance</h3>
                    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; margin-bottom:24px;">
                        <thead>
                            <tr>
                                <th align="left" style="padding:12px 10px; background:#f3f4f6; font-size:13px; color:#6b7280; border-bottom:1px solid #e5e7eb;">Name</th>
                                <th align="right" style="padding:12px 10px; background:#f3f4f6; font-size:13px; color:#6b7280; border-bottom:1px solid #e5e7eb;">Price / day</th>
                                <th align="right" style="padding:12px 10px; background:#f3f4f6; font-size:13px; color:#6b7280; border-bottom:1px solid #e5e7eb;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding:12px 10px; border-bottom:1px solid #e5e7eb;">{{ $booking->insurance_name ?? $booking->insurance?->name }}</td>
                                <td align="right" style="padding:12px 10px; border-bottom:1px solid #e5e7eb;">{{ number_format((float) ($booking->insurance_price ?? $booking->insurance?->price ?? 0), 2) }} {{ $booking->currency }}</td>
                                <td align="right" style="padding:12px 10px; border-bottom:1px solid #e5e7eb;">{{ number_format((float) $booking->insurance_total, 2) }} {{ $booking->currency }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="margin-top:10px;">
                    <h3 style="margin:0 0 12px; font-size:18px; color:#111827;">Detailed extras</h3>
                    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; margin-bottom:24px;">
                        <thead>
                            <tr>
                                <th align="left" style="padding:12px 10px; background:#f3f4f6; font-size:13px; color:#6b7280; border-bottom:1px solid #e5e7eb;">Extra</th>
                                <th align="right" style="padding:12px 10px; background:#f3f4f6; font-size:13px; color:#6b7280; border-bottom:1px solid #e5e7eb;">Qty</th>
                                <th align="right" style="padding:12px 10px; background:#f3f4f6; font-size:13px; color:#6b7280; border-bottom:1px solid #e5e7eb;">Unit price / day</th>
                                <th align="right" style="padding:12px 10px; background:#f3f4f6; font-size:13px; color:#6b7280; border-bottom:1px solid #e5e7eb;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($booking->extras as $extra)
                                <tr>
                                    <td style="padding:12px 10px; border-bottom:1px solid #e5e7eb;">{{ $extra->name }}</td>
                                    <td align="right" style="padding:12px 10px; border-bottom:1px solid #e5e7eb;">{{ $extra->quantity }}</td>
                                    <td align="right" style="padding:12px 10px; border-bottom:1px solid #e5e7eb;">{{ number_format((float) $extra->unit_price, 2) }} {{ $booking->currency }}</td>
                                    <td align="right" style="padding:12px 10px; border-bottom:1px solid #e5e7eb;">{{ number_format((float) $extra->total_price, 2) }} {{ $booking->currency }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="padding:12px 10px; border-bottom:1px solid #e5e7eb; color:#6b7280;">No extras selected.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div style="margin-top:10px;">
                    <h3 style="margin:0 0 12px; font-size:18px; color:#111827;">Price summary</h3>
                    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; margin-bottom:6px;">
                        <tr>
                            <td style="padding:8px 0; color:#6b7280;">Subtotal</td>
                            <td align="right" style="padding:8px 0; font-weight:600;">{{ number_format((float) $booking->subtotal, 2) }} {{ $booking->currency }}</td>
                        </tr>
                        <tr>
                            <td style="padding:8px 0; color:#6b7280;">Extras total</td>
                            <td align="right" style="padding:8px 0; font-weight:600;">{{ number_format((float) $booking->extras_total, 2) }} {{ $booking->currency }}</td>
                        </tr>
                        <tr>
                            <td style="padding:8px 0; color:#6b7280;">Insurance total</td>
                            <td align="right" style="padding:8px 0; font-weight:600;">{{ number_format((float) $booking->insurance_total, 2) }} {{ $booking->currency }}</td>
                        </tr>
                        <tr>
                            <td style="padding:8px 0; color:#6b7280;">Tax</td>
                            <td align="right" style="padding:8px 0; font-weight:600;">{{ number_format((float) $booking->tax_total, 2) }} {{ $booking->currency }}</td>
                        </tr>
                        <tr>
                            <td style="padding:12px 0 0; font-size:18px; font-weight:700; color:#111827;">Total price</td>
                            <td align="right" style="padding:12px 0 0; font-size:18px; font-weight:700; color:#111827;">{{ number_format((float) $booking->total_amount, 2) }} {{ $booking->currency }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
