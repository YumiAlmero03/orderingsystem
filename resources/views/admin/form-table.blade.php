<form method="POST" action="{{route('table.store')}}">
	@csrf
	<input type="text" name="place" placeholder="Table Place">
	<input type="hidden" name="status" value="done" >
	<input type="submit" name="submit" value="Add">
</form>