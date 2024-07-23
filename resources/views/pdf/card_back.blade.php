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
            align-items: center;
            justify-content: center;
        }
        .logo {
            width: 150px;
            height: 150px;
            opacity: 0.1;
        }
        .info {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="card">
        <img src="{{ asset('storage/university_logo.png') }}" alt="University Logo" class="logo">
        <div class="info">
            <p><strong>University Name</strong></p>
            <p>Address: 123 University St, City, Country</p>
            <p>Phone: +123 456 7890</p>
            <p>Website: www.universitywebsite.com</p>
        </div>
    </div>
</body>
</html>
