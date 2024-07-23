<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
</head>
<body>
    <h1>Receipt for Card Request</h1>
    <p>Request ID: {{ $request->id }}</p>
    <p>User: {{ $request->user->name }}</p>
    <p>Email: {{ $request->user->email }}</p>
    <p>Status: {{ $request->status }}</p>
</body>
</html>
