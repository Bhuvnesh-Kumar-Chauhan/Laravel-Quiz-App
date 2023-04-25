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
        <h1>Login Page</h1>
        <hr>
        <form action="{{url('login-user')}}" method="POST">
            @csrf
            @if (Session::has('success'))
                {{Session::get('success')}}
            @endif
            @if (Session::has('fail'))
                {{Session::get('fail')}}
            @endif
            <div>
                Email:<input type="email" name="email" placeholder="Enter your email" value="{{old('email')}}"><br>
                <span>@error('email'){{$message}}@enderror</span>
            </div>
            <br>
            <div>
               Password: <input type="password" name="password" placeholder="Enter your password" value="{{old('password')}}"><br>
                <span>@error('password'){{$message}}@enderror</span>
            </div>
            <br>
            <div>
                Confirm-Password:<input type="password" name="confirm-password" placeholder="Enter your confirm-password" value="{{old('password')}}"><br>
                <span>@error('password'){{$message}}@enderror</span>
            </div>
            <br>
            <div>
                <button type="submit">Login</button><br>
            </div>
            <br>
            <a href="registration">New User Registration Here !</a>
        </form>
    </div>
</body>
</html>