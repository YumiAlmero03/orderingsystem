@extends('layouts.app')

@section('content')
<div class="filter" style="margin-bottom:20px">
        <label>DATE</label>
        <input type="date" name="start_date" id="start_date" value="{{$start_date}}">
        <input type="date" name="end_date" id="end_date" value="{{$end_date}}">
        <a><button class="btn btn-primary" id="search">Search</button></a>
        <a href="{{route('export', ['start'=>$start_date,'end'=>$end_date])}}"><button class="btn btn-primary" >Export</button></a>
</div>
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
            <td>{{$table->orderByDate($start_date, $end_date)->sum('quantity')}}</td>
            <td>{{($table->price * $table->orderByDate($start_date, $end_date)->sum('quantity'))}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('script')

$(document).ready( function () {
    $('#search').click(function(){
        start = $('#start_date').val();
        end = $('#end_date').val();
        console.log("reports/"+start+"/"+end);
        location.replace("{{route('report')}}/"+start+"/"+end);
    })

    $('table').DataTable();
});
@endsection
