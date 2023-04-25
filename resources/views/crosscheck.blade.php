<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Previous Result</title>

</head>
<body>



    <table border="2px solid blue">
 
        <thead>
            <tr>
                <th>Question Name</th>
                <th>Right Answer</th>
                <th>Selected_Answers</th>
                <th>Check Iscorrect_Answer</th>  
                
            </tr>
        </thead>
        <tbody>
            @foreach ($value as $item )
                <tr>
                    <td>{{$item->question_name}}</td>
                    <td>{{$item->answer}}</td>
                    <td>{{$item->selected_ans}}</td>
                    <td>{{$item->isCorrect}}</td>
                </tr>
            
            @endforeach

        </tbody>
        
    </table>


    <br>
    <div>
        <a href="/dashboard">GO TO DASHBOARD</a>
    </div>
    
</body>
</html>