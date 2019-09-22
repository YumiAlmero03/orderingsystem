<form method="POST" action="{{route('category.store')}}">
	@csrf
	<input type="text" name="name" placeholder="Category Name">
	<input type="submit" name="submit" value="Add">
</form>