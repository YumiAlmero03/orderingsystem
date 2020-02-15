<form action="{{ route('food.store') }}" method="POST" enctype="multipart/form-data">
	@csrf
	<input type="text" name="name" placeholder="Menu Name">
	<input type="text" name="price" placeholder="Menu Price">
	<textarea placeholder="Menu Description" name="desc"></textarea>
	<input type="file" name="pic" class="form-control">
	<p>Category:</p>
	<select name="category_id">
		<option value="1">Rice</option>
	</select>
	<input type="submit" class="btn btn-primary" name="Submit">
</form>
