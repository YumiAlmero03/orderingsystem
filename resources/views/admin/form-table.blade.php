
    <div class="form-group row">
        <div class="col-sm-1">
            <form method="POST" action="{{route('table.store')}}">
                @csrf
                <input type="hidden" class="form-control" name="place" value="name" placeholder="Table Place">
                <input type="hidden" name="status" value="vacant" >
                <input type="submit" class="btn btn-primary" name="submit" value="Add">
            </form>
        </div>
        <div class="col-sm-1">
            <form action="{{route('table.remove')}}" method="POST">
                @csrf
                <button class="btn btn-secondary delete" type="submit">Delete</button></td>
            </form>
        </div>
    </div>

