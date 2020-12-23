<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <h3>{{ $user->name }}</h3>
        <p>Thanks for registration <br>
            Please Verify your account for complete registration.Please click here...
        </p>
        <a href="{{ route('verify',$user->verification_token) }}">
            Click{{ route('verify',$user->verification_token) }}
        </a>
    </div>
</body>
</html>
