Form::open(array('url' => 'route('food.store')','files'=>'true'))
	@csrf
	<input type="text" name="name" placeholder="Menu Name">
	<input type="text" name="price" placeholder="Menu Price">
	<textarea placeholder="Menu Description" name="desc"></textarea>
	Form::file('image');
	<p>Category:</p>
	<select name="category">
		<option value="rice">Rice</option>
	</select>
	Form::submit('Add')
	Form::close()
</form>