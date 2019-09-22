@extends('costumer.layout')

@section('content')
<form method="POST" class="form-group" action="/order">
	@csrf
	<input type="text" max="8" min="8" class="form-control" name="username" placeholder="username">
	<input type="password" class="form-control" name="pass" placeholder="password">
	<input type="submit" name="submit" class="btn btn-primary" value="Submit">
</form>

@endsection