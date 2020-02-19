<html>
<table id="table" class="table table-striped table-bordered">
	<thead>
    <tr>
		<th>Menu ID</th>
		<th>Menu</th>
        <th>Menu Category</th>
		<th>QTY</th>
		<th>Total Amount</th>
	</tr>
    </thead>
    <tbody>
        @foreach ($tables as $table)
        <tr>
            <td>{{$table->id}}</td>
            <td>{{$table->name}}</td>
            <td>{{$table->category['name']}}</td>

            @if($cat === 'default')
                <td>{{$table->order()->sum('quantity')}}</td>
                <td>{{($table->price * $table->order()->sum('quantity'))}}</td>
            @else
                <td>{{$table->orderByDate($start_date, $end_date)->sum('quantity')}}</td>
                <td>{{($table->price * $table->orderByDate($start_date, $end_date)->sum('quantity'))}}</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
