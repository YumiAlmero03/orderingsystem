<form method="POST" action="{{route('category.store')}}">
	@csrf
    <div class="form-group row">
        <div class="col-sm-5">
	        <input type="text" name="name" class="form-control" placeholder="Category Name">
	    </div>

        <div class="col-sm-5">
            <input type="submit" class="btn btn-primary" name="submit" value="Add">
        </div>
    </div>
</form>
