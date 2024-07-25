<!DOCTYPE html>
<html>
<head>
    <title>Mail</title>
</head>
<body>
    <p>Hello {{ $name }},</p>
    @if($status !== 'pending')
        <p>We want to inform you that your request has been {{ $status }}.</p>
    @else
        <p>We're sorry to inform you that there has been a mistake while handling your request.</p>
    @endif
</body>
</html>
