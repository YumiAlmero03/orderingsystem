@extends('costumer.layout')

@section('content')
<div class="card">
	<div class="card-header">
		<h2> Thank you!</h2>
		<h3>Please wait for your order</h3>
	</div>
	<div class="card-body">
		<div class="timer">
			<p class="change-order ">You can change your order in 5 mins.</p>
			<form class="change-order" method="POST" action="/reorder" >
				@csrf
				<input type="submit" class="change-order btn btn-outline-secondary" name="submit" value="Change Order">
				<input type="hidden" name="username" value="{{$order->username}}">
			</form>
		</div>
		<p>ET: <span id="demo"></span></p>
		<p>Status: <span id="stats">{{$order->status}}</span></p>
	</div>
	<div class="card-footer">
		<p>While you wait, please participate in our survey: <a href="https://docs.google.com/forms/d/e/1FAIpQLSdMZDhIoExab9U4WffylVR-rhJClr8Rovjr1-Znj-u45s3wxg/viewform?usp=sf_link" target="_blank"><button class=" btn btn-secondary ">Survey</button></a></p>
	</div>
</div>
@endsection

@section('script')
// Set the date we're counting down to
var countDownDate = new Date("{{Carbon\Carbon::parse("$order->order_at")->addMinutes(20)}}").getTime();//"Aug 14, 2019 15:37:25"

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
    document.getElementById("demo").innerHTML = "Please Wait";
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

	xmlhttp.open("GET", "{{secure_url(route('apistat', ['id' => $order->id]))}}", true)
	xmlhttp.send();

}, 1000);

@endsection
