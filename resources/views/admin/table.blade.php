@extends('layouts.app')

@section('content')

	@include('admin/form-table')

<table  class="table table-striped table-bordered">
	<tr>
		<th>Table</th>
		<th>Status</th>
	</tr>
	@foreach ($tables as $table)
	<tr>
		<td>{{$table->id}}</td>
		<td>{{$table->status}}</td>
	</tr>
	@endforeach
</table>
@endsection

@section('script')

@endsection
