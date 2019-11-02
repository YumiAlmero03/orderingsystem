@extends('layouts.app')

@section('content')

<table>
	<tr>
		<th>Table</th>
		<th>Costumer</th>
		<th>Status</th>
		<th>Place</th>
		<th>Action</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	@foreach ($tables as $table)
	<tr>
		<td>{{$table->id}}</td>
		<td>{{$table->transaction['username']}}</td>
		<td>{{$table->status}}</td>
		<td>{{$table->place}}</td>
		<td>
			<form id="table-status" method="POST" action="/status-change">
				@csrf
				<input type="hidden" name="id" value="{{$table->transaction['id']}}">
				@switch($table->status)
				@case('recording')
					<a href=""><button type="submit" class="btn btn-primary">Record</button></a>
					<input type="hidden" name="status" value="cooking">
				@break
				@case('cooking')
					<a href=""><button type="submit" class="btn btn-primary">Prepare</button></a>
					<input type="hidden" name="status" value="preparing">
				@break
				@case('preparing')
					<a href=""><button type="submit" class="btn btn-primary">Serve</button></a>
					<input type="hidden" name="status" value="serving">
				@break
				@case('serving')
					<a href=""><button type="submit" class="btn btn-primary">Served</button></a>
					<input type="hidden" name="status" value="eating">
				@break
				@case('eating')
					<a href=""><button type="submit" class="btn btn-primary">Bill-Out</button></a>
					<input type="hidden" name="status" value="billout">
				@break
				@case('billout')
					<a href=""><button type="submit" class="btn btn-primary">Paid</button></a>
					<input type="hidden" name="status" value="paid">
				@break
				@case('paid')
					<a href=""><button type="submit" class="btn btn-primary">Done</button></a>
					<input type="hidden" name="status" value="done">
				@break
				@default
					Wait
		@endswitch
			</form>
		</td>
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
	@include('admin/form-table')
@endsection

@section('script')

@endsection
