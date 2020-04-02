@extends('costumer.layout')
@section('title')
	Welcome!
@endsection
@section('content')
<div class="card">
	<div class="card-header" >
		<h3>Order</h3>
	</div>
	<div class="card-body">
		<form method="POST" class="form-group" action="/order">
			@csrf
			<input type="text" max="8" min="8" class="form-control" name="username" placeholder="UserID">
			<input type="password" class="form-control" name="pass" placeholder="Pasword">
			<p></p>
			<input type="submit" name="submit" class="btn btn-primary form-control" value="Submit">
		</form>
	</div>
</div>
@endsection