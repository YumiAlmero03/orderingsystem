@extends('layouts.app')

@section('content')
<table>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Feature</th>
		<th>Availability</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	@foreach ($tables as $table)
	<tr>
		<td>{{$table->id}}</td>
		<td>{{$table->name}}</td>
		<td>
			<form id="table-status" method="POST" action="{{route('food.feat')}}">
				@csrf
				<input type="hidden" name="id" value="{{$table->id}}">
				@switch($table->feat)
					@case(0)
						<input type="hidden" name="binary" value="1">
						<a href=""><button type="submit" class="btn btn-primary">Feature</button></a>
					@break
					@case(1)
						<input type="hidden" name="binary" value="0">
						<a href=""><button type="submit" class="btn btn-primary">Remove</button></a>
					@break
				@endswitch
			</form>
		</td>
		<td>
			<form id="table-status" method="POST" action="{{route('food.availability')}}">
				@csrf
				<input type="hidden" name="id" value="{{$table->id}}">
				@switch($table->active)
					@case(0)
						<input type="hidden" name="binary" value="1">
						<a href=""><button type="submit" class="btn btn-primary">Available</button></a>
					@break
					@case(1)
						<input type="hidden" name="binary" value="0">
						<a href=""><button type="submit" class="btn btn-primary">Unavailable</button></a>
					@break
				@endswitch
			</form>
		</td>
		<td>
			<button class="btn btn-secondary edit">Edit</button>
		</td>
		<td>
			<form action="{{route('food.remove')}}" method="POST">
				@csrf
				<input type="hidden" name="id" value="{{$table->id}}">
				<button class="btn btn-secondary delete" type="submit">Delete</button>
			</form>
		</td>
	</tr>	
	@endforeach
</table>
	@include('admin/form-menu')
@endsection

@section('script')

@endsection
