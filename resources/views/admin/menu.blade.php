@extends('layouts.app')

@section('content')
<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#orderModal">
Add Menu
</button>
<table  class="table table-striped table-bordered">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Category</th>
		<th>Feature</th>
		<th>Availability</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	@foreach ($tables as $table)
	<tr>
		<td>{{$table->id}}</td>
		<td>{{$table->name}}</td>
        <td>{{$table->category['name']}}</td>
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
			<a href="{{route('food.edit',['food'=>$table->id])}}"><button class="btn btn-secondary edit">Edit</button></a>
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

    <!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderModalLabel">Add Menu <span id="orderModalUsername"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            @include('admin/form-menu')
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')

@endsection
