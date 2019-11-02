@extends('layouts.app')

@section('content')
<table>
	<tr>
		<th>ID</th>
		<th>Category</th>
		<th>Action</th>
	</tr>
	@foreach ($tables as $table)
	<tr>
		<td>{{$table->id}}</td>
		<td>{{$table->name}}</td>
		<td>
			<button class="btn btn-secondary edit" data-catID="{{$table->id}}">Edit</button>
			<form action="{{route('category.remove')}}" method="POST">
				@csrf
				<input type="hidden" name="id" value="{{$table->id}}">
				<button class="btn btn-secondary delete" type="submit">Delete</button></td>
			</form>
			
		</td>
	</tr>	
	@endforeach
</table>
	
	@include('admin/form-category')
@endsection

@section('script')

@endsection
