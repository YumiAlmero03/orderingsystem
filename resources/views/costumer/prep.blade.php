@extends('costumer.layout')
@section('title')
Order Status: {{$order->status}}
@endsection

@section('content')

<div class="card">
	<div class="card-header">
		<h2> Thank you!</h2>
		<h3>Please wait for your order</h3>
	</div>
	<div class="card-body">
		<div class="timer">
			<p class="change-order ">You can change your order in 3 mins.</p>
			<form class="change-order" method="POST" action="/reorder" >
				@csrf
				<input type="submit" class="change-order btn btn-outline-secondary" name="submit" value="Change Order">
				<input type="hidden" name="username" value="{{$order->username}}">
			</form>
		</div>
		<p>ET: <span id="demo"></span></p>
		<p><span id="stats"></span></p>
		<p><span id="title"></span></p>

        </div>
	<div class="card-footer">
				@include('costumer._survey')
    </div>
</div>

@endsection

@section('script')
var countDownDate = new Date("{{Carbon\Carbon::parse("$order->updated_at")->addMinutes(intval($order->preptime))}}").getTime();

// Update the count down every 1 second
var x = setInterval(function() {
  var now = new Date().getTime();
  var distance = countDownDate - now;
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.getElementById("demo").innerHTML =
  + minutes + "m " + seconds + "s ";

    if(minutes == {{intval($order->preptime) - 3}}){
        $(".change-order").remove();
    }
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "Please Wait...";
    }

}, 1000);

var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function(){
	if (this.readyState == 4 && this.status == 200){
		var myObj = JSON.parse(this. responseText);
		document.getElementById("stats").innerHTML = "Order Status: "+myObj;
		document.getElementById("title").innerHTML = myObj;
		if(myObj == "serving" || myObj == "serving" || myObj == "served"){
			window.location.replace('{{route('done', ['id' => $order->id])}}');
		}
		if(myObj == "cooking"){
			$(".change-order").remove();
		}
	}
};
setInterval(function(){

	xmlhttp.open("GET", "{{secure_url(route('apistat', ['id' => $order->id]))}}", true)
	xmlhttp.send();

}, 1000);

@endsection
