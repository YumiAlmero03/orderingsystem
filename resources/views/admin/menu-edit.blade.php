@extends('layouts.app')

@section('content')
<form action="{{ route('food.update',['food'=>$menu->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input name="_method" type="hidden" value="PUT">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="menu-name">Menu Name</span>
        </div>
        <input type="text" class="form-control" name="name" value="{{$menu->name}}" id="menuname" placeholder="Menu Name" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="menu-price">Menu Price</span>
        </div>
        <input type="number" class="form-control" name="price" value="{{$menu->price}}" id="menuprice" placeholder="Menu Price" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="menu-prepare">Prepare Time</span>
        </div>
        <input type="number" class="form-control" name="prepare_time" value="{{$menu->prepare_time}}" id="menuprepare" placeholder="Menu Prepare Time" aria-label="Username" aria-describedby="basic-addon1">
        <div class="input-group-prepend">
            <span class="input-group-text" id="menu-min">Mins</span>
        </div>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Menu Description</span>
        </div>
        <textarea class="form-control" placeholder="Menu Description" name="desc" id="menudesc" aria-label="Menu Description">{{$menu->desc}}</textarea>
    </div>
	<div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Upload</span>
        </div>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="pic" id="inputGroupFile01">
            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
        </div>
    </div>
    <img src="{{asset('/img/'.$menu->pic)}}" width="200px">
    <div class="input-group mb-3 mt-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Category:</label>
        </div>
        <select class="custom-select" name="category_id" id="inputGroupSelect01">
            <option value="{{$menu->category->id}}" selected>{{$menu->category->name}}</option>
            @foreach($cats as $cat)
                @if($menu->category->id === $cat->id)
                @else
                <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endif
            @endforeach
        </select>
    </div>
	<input type="submit" class="btn btn-primary" name="Submit">
</form>

@endsection

@section('script')

@endsection
