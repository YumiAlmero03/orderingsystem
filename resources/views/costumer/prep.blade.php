@extends('costumer.layout')

@section('content')
<h1> Thank you!</h1>
<h2>Please wait for your order</h2>
<div class="timer">
	
	<p class="change-order ">You can change your order in 5 mins.</p>
	<form class="change-order" method="POST" action="/reorder" >
		@csrf
		<input type="submit" class="change-order btn btn-outline-secondary" name="submit" value="Change Order">
		<input type="hidden" name="id" value="{{$order->id}}">
	</form>
</div>
<p>ET: <span id="demo"></span></p>
<p>Status: <span id="stats">{{$order->status}}</span></p>
@endsection

@section('script')
// Set the date we're counting down to
var countDownDate = new Date("{{Carbon\Carbon::now()->addMinutes(20)}}").getTime();//"Aug 14, 2019 15:37:25"

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text 
  	if(minutes == 15){
	  $(".change-order").remove();
	}
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "Done";
  }
}, 1000);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function(){
	if (this.readyState == 4 && this.status == 200){
		var myObj = JSON.parse(this. responseText);
		document.getElementById("stats").innerHTML = myObj;
		if(myObj == "serving"){
			window.location.replace('{{route('done', ['id' => $order->id])}}');
		}
		if(myObj == "cooking"){
			document.getElementByClassName("change-order").remove();
		}
	}
};
setInterval(function(){
	
	xmlhttp.open("GET", "{{route('apistat', ['id' => $order->id])}}", true)
	xmlhttp.send();

}, 1000);

@endsection