<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Previous Result</title>

</head>
<body>
    
    <marquee behavior="" direction=""><h2> Your Examination History </h2></marquee>


    <table border="2px solid blue">
 
        <thead>
            <tr>
                <th>Name</th>
                <th>Student ID </th>
                <th> Result</th>
                <th>Your Grade is</th>
                <th>Correct_Answers</th>
                <th>Incorrect_Answers</th>
                <th>No_Attempt</th>
                <th>Time</th>
               
                
                
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{$name['name']}}</td>
                    <td>{{$item['student_id']}}</td>
                    <td>{{$item['result']}}</td>
                    <td>{{$item['marks']}}</td>
                    <td>{{$item['correct']}}</td>
                    <td>{{$item['Incorrect']}}</td>
                    <td>{{$item['No_Attempt']}}</td>
                    <td>{{$item['created_at']}}</td>
                    
                    
                </tr>
            
            @endforeach
        </tbody>
        
    </table>


    <br>
    <div>
        <a href="/dashboard">GO TO DASHBOARD</a>
    </div>
    <br><br>
   <div>
    <a href="/is">Check Selected Answer </a>
    </div>
    <br><br>
    
</body>
</html>