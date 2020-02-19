@extends('layouts.app')

@section('content')

	@include('admin/form-table')

<table  class="table table-striped table-bordered">
	<tr>
		<th>Table</th>
		<th>Status</th>
		<th>Place</th>
		<th>Delete</th>
	</tr>
	@foreach ($tables as $table)
	<tr>
		<td>{{$table->id}}</td>
		<td>{{$table->transaction['status']}}</td>
		<td>{{$table->place}}</td>
		<td>
			<form action="{{route('table.remove')}}" method="POST">
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
