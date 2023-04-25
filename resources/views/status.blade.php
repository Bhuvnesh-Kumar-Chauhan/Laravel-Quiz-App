<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
  </head>
  <body>
    <form action="{{url('/status')}}" method="POST">

      {{csrf_field()}}
      @foreach($display as $ques)
        {{$ques->question_name}}
           <input type="hidden" name= "ques->id" value="{{$ques->id}}"  >
           <div class="option">
            
            <input type="radio" name="option_id" value="1"  >
            {{$ques->opt1}} <br>
            <input type="radio" name="option_id" value="2"  >
            {{$ques->opt2}} <br>
            <input type="radio" name="option_id" value="3"  >
            {{$ques->opt3}} <br>
            <input type="radio" name="option_id" value="4"  >
            {{$ques->opt4}} <br>
           </div>
           <input type="radio" name="{{$ques->id}}" value="0" checked="checked" hidden="">
  
      @endforeach
      <input type="submit" name="submit"  value="Next" class="btn btn-success">
      <input type="reset" name="reset"  value="reset" class="btn btn-success">

      {{-- {{$display->links()}} --}}
  
    </form>


  </body>
  </html>