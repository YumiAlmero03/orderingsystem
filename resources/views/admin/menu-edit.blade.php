@extends('layouts.app')

@section('content')
<form action="{{ route('food.update',['food'=>$menu->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input name="_method" type="hidden" value="PUT">
    <input type="text" name="name" placeholder="Menu Name" value="{{$menu->name}}">
	<input type="text" name="price" placeholder="Menu Price" value="{{$menu->price}}">
	<textarea placeholder="Menu Description" name="desc">{{$menu->desc}}</textarea>
    <input type="file" name="pic" class="form-control" >
    <img src="{{asset('/img/'.$menu->pic)}}">
    <p>Category:</p>
	<select name="category_id">
		<option value="1">Rice</option>
	</select>
	<input type="submit" class="btn btn-primary" name="Submit">
</form>

@endsection

@section('script')

@endsection
