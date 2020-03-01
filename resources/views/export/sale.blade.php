<table id="table" class="table table-striped table-bordered">
	<thead>
                    @include('export/_heading')

        <tr>
            <th style="width:20px;word-wrap:break-word;text-align:center;background:#dee2e6;">Transaction</th>
            <th style="width:20px;word-wrap:break-word;text-align:center;background:#dee2e6;">Status</th>
            <th style="width:20px;word-wrap:break-word;text-align:center;background:#dee2e6;">Table</th>
            <th style="width:25px;word-wrap:break-word;text-align:center;background:#dee2e6;">Total Amount Purchased</th>
            <th style="width:20px;word-wrap:break-word;text-align:center;background:#dee2e6;">In</th>
            <th style="width:20px;word-wrap:break-word;text-align:center;background:#dee2e6;">Out</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tables as $table)
            <tr>
                <td style="width:20px;word-wrap:break-word;text-align:center">{{$table->username}}</td>
                <td style="width:20px;word-wrap:break-word;text-align:center">{{$table->status}}</td>
                <td style="width:20px;word-wrap:break-word;text-align:center">{{$table->table_id}}</td>
                <td style="width:20px;word-wrap:break-word;text-align:center">{{$table->price}}</td>
                <td style="width:20px;word-wrap:break-word;text-align:center">{{$table->created_at}}</td>
                <td style="width:20px;word-wrap:break-word;text-align:center">{{$table->updated_at}}</td>
            </tr>
            <tr>
                <td style="width:20px;word-wrap:break-word;text-align:center;background:#abdefa;">Transactions:</td>
                <td style="width:20px;word-wrap:break-word;text-align:center;background:#abdefa;">Menu</td>
                <td style="width:20px;word-wrap:break-word;text-align:center;background:#abdefa;">Quantity</td>
                <td style="width:20px;word-wrap:break-word;text-align:center;background:#abdefa;">Price</td>
                <td style="width:20px;word-wrap:break-word;text-align:center;background:#abdefa;">Total</td>
                <td style="width:20px;word-wrap:break-word;text-align:center;background:#abdefa;"></td>

            </tr>
            @foreach ($table->order as $order)
                @if($order->quantity != 0)
                <tr>
                    <td ></td>
                    <td style="width:20px;word-wrap:break-word;text-align:center">{{$order->menu->name}}</td>
                    <td style="width:20px;word-wrap:break-word;text-align:center">{{$order->quantity}}</td>
                    <td style="width:20px;word-wrap:break-word;text-align:center">{{$order->menu->price}}</td>
                    <td style="width:20px;word-wrap:break-word;text-align:center">{{$order->quantity * $order->menu->price}}</td>
                </tr>
                @endif
            @endforeach
            <tr>
                <td> &nbsp;</td>
            </tr>

        @endforeach
    </tbody>
</table>
