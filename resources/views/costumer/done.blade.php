@extends('costumer.layout')

@section('content')
<div class="card">
	<div class="card-header">
		<h1>Your food is served!</h1>
	</div>
	<div class="card-body">
		<p>For additional order or request. you can request to the form below</p>
		<form method="POST" action="/request" class="form-group">
			<textarea class="form-control" placeholder="Request Here"></textarea>
			<input type="submit" class="btn btn-outline-secondary" name="submit" value="Request">
		</form>
		<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#orderModal">
		  View Orders
		</button>
	</div>
	<div class="card-footer">
		<form id="table-status" method="POST" action="/status-change">
			<input type="hidden" name="id" value="{{$order->id}}">
			<a href=""><button type="submit" class="btn btn-primary">Bill-Out</button></a>
			<input type="hidden" name="status" value="billout">
		</form>
		You can also participate in our survey
		<a href=""><button class="btn btn-outline-primary">Survey</button></a>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderModalLabel">Order: {{$order->username}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<table border="0">
      		<tr>
      			<th>Menu</th>
      			<th>Quantity</th>
      			<th>Price</th>
      		</tr>
      		@foreach ($order->order as $menu)
      		@if($menu->quantity == 0)
      		@else
      		<tr>
      			<td>{{$menu->menu->name}}</td>
      			<td>{{$menu->quantity}}</td>
      			<td>{{$menu->menu->price}}</td>
      		</tr>
	      	@endif
	      	@endforeach
	      	<tr>
	      		<th>Total:</th>
	      		<td>{{$order->price}}</td>
	      	</tr>
      	</table>
      	
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
@endsection