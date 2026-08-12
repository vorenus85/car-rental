<p>You have received a new message from the storefront contact form.</p>

<p>
    <strong>Name:</strong> {{ $messageData['name'] }}<br>
    <strong>Email:</strong> {{ $messageData['email'] }}<br>
    <strong>Phone:</strong> {{ $messageData['phone'] ?: 'Not provided' }}<br>
    <strong>Subject:</strong> {{ $messageData['subject'] }}
</p>

<p><strong>Message:</strong></p>

<p>{!! nl2br(e($messageData['message'])) !!}</p>
