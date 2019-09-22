<form method="POST" action="{{route('food.store')}}">
	@csrf
	<input type="text" name="name" placeholder="Menu Name">
	<input type="text" name="price" placeholder="Menu Price">
	<textarea placeholder="Menu Description" name="desc"></textarea>
	<p>Category:</p>
	<select name="category">
		<option value="rice">Rice</option>
	</select>

	<input type="submit" name="submit" value="Add">
</form>