@extends('layouts.app')

@section('content')
<div class="filter">
    <label>DATE</label>
    <input type="date" name="start_date" id="start_date" value="{{Carbon\Carbon::now()->toDateString()}}">
    <input type="date" name="end_date" id="end_date" value="{{Carbon\Carbon::now()->toDateString()}}">
    <a><button class="btn btn-primary" id="search">Search</button></a>
    <a><button class="btn btn-primary" >Export</button></a>

</div>
<table id="table" class="table table-striped table-bordered">
	<thead>
    <tr>
		<th>Transaction</th>
		<th>Status</th>
        <th>Table</th>
		<th>Total Amount Purchased</th>
		<th>In</th>
		<th>Out</th>
		<th>Transactions</th>
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
                <td>
                    <button class="transaction btn btn-primary" type="button" data-id="{{$table->id}}" data-toggle="modal" data-target="#orderModal">
                        View Transaction
                    </button>
                </td>
            </tr>

        @endforeach
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderModalLabel">Order: <span id="orderModalUsername"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<table border="0">
            <tr>
                <th>Menu</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            <tbody id="orderModalOrders">

            </tbody>
	      	<tr>
	      		<th>Total:</th>
	      		<td id="orderModalPrice"></td>
	      	</tr>
      	</table>

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')

$(document).ready( function () {

    $('.transaction').click(function() {
        id = $(this).data('id');
        var flickerAPI = "{{route('apicostumers')}}/"+id;
        $.getJSON( flickerAPI, {
            tags: "mount rainier",
            tagmode: "any",
            format: "json"
        })
        .done(function( data ) {
            $('span#orderModalUsername').text(data.username);
            $('td#orderModalPrice').text(data.price);
            $.each( data.order, function( i, item ) {

                $( "<tr>" ).appendTo( "#orderModalOrders" );
                $( "<td>" ).text( item.quantity ).appendTo( "#orderModalOrders" );
                $( "<td>" ).text( item.quantity ).appendTo( "#orderModalOrders" );
                $( "<td>" ).text( item.quantity ).appendTo( "#orderModalOrders" );
                $( "</tr>" ).appendTo( "#orderModalOrders" );
            });
        });
    });
    $('#table').DataTable();

});
@endsection
