@extends('costumer.layout')

@section('content')
<h1>Your food is being served!</h1>
<p>For additional order or request. you can request to the form below</p>
<form method="POST" action="/request" class="form-group">
	<textarea class="form-control" placeholder="Request Here"></textarea>
	<input type="submit" class="btn btn-outline-secondary" name="submit" value="Request">
</form>
You can also participate in our survey
<button class="btn btn-outline-primary">Survey</button>
@endsection