@extends('costumer.layout')

@section('content')
	<form method="POST" action="/preparing">
		@csrf
		<input type="hidden" name="order_id" value="{{$id->id}}">
		<input type="hidden" name="order_user" value="{{$id->username}}">
		<input type="hidden" id="order-price" name="price" value="@if(Request::is('reorder')) {{$id->price}}
			@else
			0
			@endif">
		<!-- <input class="order-btn btn btn-link" type="submit" name="submit" value="Order"/> -->
		<button id="order-submit" class=" btn btn-primary btn-lg btn-block fixed @if(Request::is('reorder')): @else disabled @endif" @if(Request::is('reorder')): @else disabled="true" @endif type="submit">Order <span class="price-order">@if(Request::is('reorder'))
			PHP {{$id->price}}
			@endif</span></button>
		<h2>Total Price: <span class="price-order"></span></h2>

		<div class="accordion" id="accordionExample">
			<div class="card">
				@if($feats->count())
			  	<a class="btn-link btn order-category btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapsefeat" aria-expanded="true" aria-controls="collapsefeat">
				    <div class="card-header" id="headingfeat">
				      <h2 class="mb-0">
				        
				          Manager's Choice
				        
				      </h2>
				    </div>
				</a>
				<div id="collapsefeat" class="collapse " aria-labelledby="headingfeat" data-parent="#accordionExample">
			      	<div class="card-body">
			        <div class="row">
						@foreach ($feats as $feat)
						
						<div class="col-sm-4">
							<div class="card">
								<div class="card-header">
									<h3 class="mb-0">{{$feat->name}}</h3>
								</div>
								<div class="card-body container-fluid">
									<img src="
									{{asset('img/'.$feat->pic)}}
									
									" width="100%">
									<p>{{$feat->desc}}</p>
									<h3>Price: {{$feat->price}}</h3>
								</div>
								<div class="card-footer form-inline">
									<div class="order-number form-group center">
										<div class="dec button btn btn-primary">-</div>
										<input type="hidden" name="order['f{{$feat->id}}'][transaction_id]" value="{{$id->id}}">
										<input type="hidden" name="order['f{{$feat->id}}'][feature]" value="1">
										<input type="hidden" name="order['f{{$feat->id}}'][category_id]" value="0">
										<input type="hidden" class="price" value="{{$feat->price}}">
										<input type="hidden" name="order['f{{$feat->id}}'][menu_id]" value="{{$feat->id}}">
										<input class="form-control orders" type="text" name="order['f{{$feat->id}}'][quantity]" id="{{$feat->name}}_{{$feat->id}}" value="@if(Request::is('reorder')) {{$feat->getQuantity($id->id, 0)->quantity}}
										@else 0
									@endif">
										@if(Request::is('reorder'))
											<input type="hidden" name="order['f{{$feat->id}}'][id]" value="{{$feat->getQuantity($id->id, 0)->id">
										@endif
										<div class="inc button btn btn-primary">+</div>
									</div>
								</div>
									
							</div>
						</div>
			  			@endforeach
					</div>
					</div>
		    	</div>
		    	@endif
		    </div>
		  @foreach ($menus as $menu)
		  
		  @if($menu->menus->count())
		  <div class="card">
			<a class="btn-link btn order-category btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapse{{$menu->id}}" aria-expanded="true" aria-controls="collapse{{$menu->id}}">
			    <div class="card-header" id="heading{{$menu->id}}">
			      <h2 class="mb-0">
			        
			          {{$menu->name}}
			        
			      </h2>
			    </div>
			</a>
		    <div id="collapse{{$menu->id}}" class="collapse " aria-labelledby="heading{{$menu->id}}" data-parent="#accordionExample">
		    <div class="card-body">
		        <div class="row">
					@foreach ($menu->menus as $order)
					<div class="col-sm-4">
						<div class="card">
							<div class="card-header">
								<h2 class="mb-0">{{$order->name}}</h2>
							</div>
							<div class="card-body container-fluid">
								<img src="
								{{asset('img/'.$order->pic)}}
								
								" width="100%">
								<p>{{$order->desc}}</p>
								<h3>Price: {{$order->price}}</h3>
							</div>
							<div class="card-footer form-inline center">
								<div class="order-number form-group">
									<div class="dec button btn btn-primary">-</div>
									<input type="hidden" name="order[{{$menu->id}}{{$order->id}}][transaction_id]" value="{{$id->id}}">
									<input type="hidden" name="order[{{$menu->id}}{{$order->id}}][feature]" value="0">
									<input type="hidden" name="order[{{$menu->id}}{{$order->id}}][category_id]" value="{{$menu->id}}">
									<input type="hidden" class="price" value="{{$order->price}}">
									<input type="hidden" name="order[{{$menu->id}}{{$order->id}}][menu_id]" value="{{$order->id}}">
									<input class="form-control orders" type="text" name="order[{{$menu->id}}{{$order->id}}][quantity]" id="{{$menu->name}}_{{$order->id}}" value="@if(Request::is('reorder')) {{$order->getQuantity($id->id, $menu->id)->quantity}}
									@else 0
									@endif">
									@if(Request::is('reorder'))
										<input type="hidden" name="order['f{{$feat->id}}'][id]" value="{{$order->getQuantity($id->id, $menu->id)->id">
									@endif
									<div class="inc button btn btn-primary">+</div>
								</div>
							</div>
						</div>
					</div>
		  			@endforeach
				</div>
			</div>
		    </div>
		</div>
		  @endif
		  @endforeach
		</div>
		<div class="row">
					
		</div>
	</form>
@endsection

@section('script')

$(function() {

$(".button").on("click", function() {

  var $button = $(this);
  var oldValue = $button.parent().find("input.orders").val();
  var price = parseFloat($button.parent().find("input.price").val());
  var priceForm = $('#order-price').val();
  var priceSum = 0;
  if ($button.text() == "+") {
  		$('#order-submit').removeClass('disabled');
  		$('#order-submit').removeAttr('disabled');
	  var newVal = parseFloat(oldValue) + 1;
	  priceSum = price + parseFloat(priceForm);
	  console.log(priceForm);
	} else {
   // Don't allow decrementing below zero
    if (oldValue > 0) {
      var newVal = parseFloat(oldValue) - 1;
      priceSum = parseFloat(priceForm) - price;
    } else {
      newVal = 0;
      priceSum = parseFloat(priceForm);
    }
  }
  if(priceSum == 0){
  	$('#order-submit').addClass('disabled');
  	$('#order-submit').attr('disabled','disabled');

  }

  $button.parent().find("input.orders").val(newVal);
  $('#order-price').val(priceSum);
  $('span.price-order').text("PHP "+priceSum);
});

});
@endsection