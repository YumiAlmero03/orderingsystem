<html>
    <head>
        <style>
            td, th{
                word-wrap:break-word;
                width:5000px;
            }
        </style>
    </head>
<body>
<table id="table" class="table table-striped table-bordered">
	<thead>
            @include('export/_heading')
    <tr>
		<th style="width:20px;word-wrap:break-word;text-align:center">Menu ID</th>
		<th style="width:20px;word-wrap:break-word;text-align:center">Menu</th>
        <th style="width:20px;word-wrap:break-word;text-align:center">Menu Category</th>
		<th style="width:20px;word-wrap:break-word;text-align:center">QTY</th>
		<th style="width:20px;word-wrap:break-word;text-align:center">Total Amount</th>
	</tr>
    </thead>
    <tbody>
        @foreach ($tables as $table)
        <tr>
            <td style="word-wrap:break-word;text-align:center">{{$table->id}}</td>
            <td style="word-wrap:break-word;text-align:center">{{$table->name}}</td>
            <td style="word-wrap:break-word;text-align:center">{{$table->category['name']}}</td>

            @if($cat === 'default')
                <td style="word-wrap:break-word;text-align:center">{{$table->order()->sum('quantity')}}</td>
                <td style="word-wrap:break-word;text-align:center">{{($table->price * $table->order()->sum('quantity'))}}</td>
            @else
                <td style="word-wrap:break-word;text-align:center">{{$table->orderByDate($start_date, $end_date)->sum('quantity')}}</td>
                <td style="word-wrap:break-word;text-align:center">{{($table->price * $table->orderByDate($start_date, $end_date)->sum('quantity'))}}</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
