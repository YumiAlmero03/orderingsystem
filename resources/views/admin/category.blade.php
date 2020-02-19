@extends('layouts.app')

@section('content')
@include('admin/form-category')
<table  class="table table-striped table-bordered">
	<tr>
		<th>ID</th>
		<th>Category</th>
		<th>Delete</th>
	</tr>
	@foreach ($tables as $table)
	<tr>
		<td>{{$table->id}}</td>
		<td>{{$table->name}}</td>
		<td>
			<form action="{{route('category.remove')}}" method="POST">
				@csrf
				<input type="hidden" name="id" value="{{$table->id}}">
				<button class="btn btn-secondary delete" type="submit">Delete</button></td>
			</form>

		</td>
	</tr>
	@endforeach
</table>


@endsection

@section('script')

@endsection
