@extends('costumer.layout')

@section('content')
<h1>Your food is being served!</h1>
<p>For additional order or request. you can request to the form below</p>
<form method="POST" action="/request" class="form-group">
	<textarea class="form-control" placeholder="Request Here"></textarea>
	<input type="submit" class="btn btn-outline-secondary" name="submit" value="Request">
</form>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
You can also participate in our survey
<button class="btn btn-outline-primary">Survey</button>
@endsection