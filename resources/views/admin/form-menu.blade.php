<form action="{{ route('food.store') }}" method="POST" enctype="multipart/form-data">
	@csrf
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Menu Name</span>
        </div>
        <input type="text" class="form-control" name="name" id="menuname" placeholder="Menu Name" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Menu Price</span>
        </div>
        <input type="number" class="form-control" name="price" id="menuprice" placeholder="Menu Price" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Menu Description</span>
        </div>
        <textarea class="form-control" placeholder="Menu Description" name="desc" id="menudesc" aria-label="Menu Description"></textarea>
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
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Category:</label>
        </div>
        <select class="custom-select" name="category_id" id="inputGroupSelect01">
            <option selected>Choose...</option>
            @foreach($cats as $cat)
                <option value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
        </select>
    </div>
	<input type="submit" class="btn btn-primary" name="Submit">
</form>
