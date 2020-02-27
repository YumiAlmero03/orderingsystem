<table id="table" class="table table-striped table-bordered">
	<thead>
        <tr>
            <th colspan="6">{{ config('app.name', 'Laravel') }}</th>
        </tr>
        <tr>
            <th>Transaction</th>
            <th>Status</th>
            <th>Table</th>
            <th>Total Amount Purchased</th>
            <th>In</th>
            <th>Out</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tables as $table)
            <tr>
                <td>{{$table->username}}</td>
                <td>{{$table->status}}</td>
                <td>{{$table->table_id}}</td>
                <td>{{$table->price}}</td>
                <td>{{$table->created_at}}</td>
                <td>{{$table->updated_at}}</td>
            </tr>
            <tr>
                <td>Transactions:</td>
                <td>Menu</td>
                <td>Quantity</td>
                <td>Price</td>
                <td>Total</td>
            </tr>
            @foreach ($table->order as $order)
                @if($order->quantity != 0)
                <tr>
                    <td></td>
                    <td>{{$order->menu->name}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->menu->price}}</td>
                    <td>{{$order->quantity * $order->menu->price}}</td>
                </tr>
                @endif
            @endforeach
            <tr>
                <td> &nbsp;</td>
            </tr>

        @endforeach
    </tbody>
</table>
