
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Result</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-offset-2 col-lg-8">
				<h1 align="center">Your Result</h1>
				<br>
				<table class="table">
					<thead>
						<tr>
							<th>User ID </th>
							<th>Result</th>
							<th>Marks</th>
							<th>Correct Answers</th>
							<th>Incorrect Answers</th>
							<th>No attempt</th>
							<th>Time </th>
						</tr>
					</thead>
					<tbody>
						<tr>
							
							<td>{{$scores['user_id']}}</td>
							<td>{{$scores['result']}}</td>
							<td>{{$scores['marks']}}</td>
							<td>{{$scores['correct']}}</td>
							<td>{{$scores['incorrect']}}</td>
							<td>{{$scores['no_attempt']}}</td>
							<td>{{$scores['time']}}</td>
					
						</tr>
					</tbody>
                </table>
				<br>
				<br>
				<h4 align="center">Your Score</h4>
				 <p align="center">{{$scores['result']}}</p> 
				<br>
				<hr>
				<br>
				<a href="/dashboard">Go to DashBoard</a>
            </div>
        </div>
    </div>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>

