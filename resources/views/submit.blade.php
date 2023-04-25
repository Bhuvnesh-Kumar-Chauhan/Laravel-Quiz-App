<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/result')}}" method="POST">
        @csrf
        <center><h1>TEST COMPLETED</h1></center>
        <button type="submit">CLICK HERE TO CHECK RESULT </button>
    </form>
</body>
</html>