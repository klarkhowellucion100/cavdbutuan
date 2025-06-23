<!DOCTYPE html>
<html>

<head>
    <title>Thank You</title>
</head>

<body>
    <p>Dear {{ $data['full_name'] }},</p>

    <p><strong>Transaction Number:</strong> {{ $data['transaction_number'] }}</p>
    <p><strong>Operation Schedule:</strong> {{ \Carbon\Carbon::parse($data['visitation_schedule'])->format('F j, Y') }}
    </p>
    <p><strong>Time:</strong>
        {{ \Carbon\Carbon::createFromFormat('H:i:s', $data['time_from'])->format('h:i A') }}
        to
        {{ \Carbon\Carbon::createFromFormat('H:i:s', $data['time_to'])->format('h:i A') }}
    </p>

    <p>Thank you for submitting your Castration and Spay Request. We have received your request and will get in touch
        with you soon. You can further access the status of your request through this<a
            href="{{ config('app.url') }}/castrationandspay/tracksearchlink?tracking_number={{ $data['transaction_number'] }}">
            link
        </a></p>

    <p>Regards,<br>CAVD Team</p>
</body>

</html>
