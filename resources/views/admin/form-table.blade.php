<form method="POST" action="{{route('table.store')}}">
	@csrf
    <div class="form-group row">
        <div class="col-sm-5">
            <input type="text" class="form-control" name="place" placeholder="Table Place">
            <input type="hidden" name="status" value="done" >
        </div>

        <div class="col-sm-5">

            <input type="submit" class="btn btn-primary" name="submit" value="Add">
        </div>
    </div>
</form>
