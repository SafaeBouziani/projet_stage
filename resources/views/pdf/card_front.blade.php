<!DOCTYPE html>
<html>
<head>
    <style>
        .card {
            width: 350px;
            height: 200px;
            border: 1px solid #000;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            width: 50px;
            height: 50px;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
        }
        .photo {
            width: 100px;
            height: 120px;
            border: 1px solid #000;
            margin: 10px 0;
        }
        .details {
            flex-grow: 1;
        }
        .details p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <img src="{{ asset('storage/university_logo.png') }}" alt="University Logo" class="logo">
            <div class="title">University Name</div>
        </div>
        <div class="photo">
            <img src="{{ asset('storage/photos/' . $cardInfo->photo) }}" alt="Employee Photo" style="width: 100%; height: 100%;">
        </div>
        <div class="details">
            <p><strong>Name:</strong> {{ $cardInfo->full_name }}</p>
            <p><strong>Email:</strong> {{ $cardInfo->email }}</p>
            <p><strong>Phone:</strong> {{ $cardInfo->phone_number }}</p>
            <p><strong>CIN:</strong> {{ $cardInfo->CIN }}</p>
            <p><strong>Institution:</strong> {{ $cardInfo->institution }}</p>
            <p><strong>Position:</strong> {{ $cardInfo->position }}</p>
            <p><strong>Type:</strong> {{ ucfirst($cardInfo->type) }}</p>
        </div>
    </div>
</body>
</html>
