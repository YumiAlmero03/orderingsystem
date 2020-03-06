@extends('layouts.app')
@section('style')
td, th{
    text-align:center!important;
    padding:10px;
}
td.right, span.right{
    display:flex;
}
@endsection

@section('content')
<div class="filter">
    <label>DATE</label>
    <input type="date" name="start_date" id="start_date" value="{{$start_date}}">
    <input type="date" name="end_date" id="end_date" value="{{$end_date}}">
    <a><button class="btn btn-primary" id="search">Search</button></a>
    <a href="{{route('sales-export', ['start'=>$start_date,'end'=>$end_date])}}"><button class="btn btn-primary" >Export</button></a>

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
                <td class="right"><span>PHP</span> <span style="margin-left:auto;">{{number_format($table->price)}}</span></td>
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
      	<table border="1">
            <tr>
                <th width="150px">Menu</th>
                <th>QYT</th>
                <th width="150px">Price</th>
                <th width="200px">Total</th>
            </tr>
            <tbody id="orderModalOrders">

            </tbody>
	      	<tr>
	      		<th colspan="3">Total:</th>
	      		<td id="orderModalPrice" ></td>
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
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $('#search').click(function(){
        start = $('#start_date').val();
        end = $('#end_date').val();
        console.log("reports/"+start+"/"+end);
        location.replace("{{route('sales')}}/"+start+"/"+end);
    });
    $('.transaction').click(function() {
        id = $(this).data('id');
        var flickerAPI = "{{route('apicostumers')}}/"+id;
        $('#orderModalOrders').text("");
        $.getJSON( flickerAPI, {
            tags: "mount rainier",
            tagmode: "any",
            format: "json"
        })
        .done(function( data ) {
            $('span#orderModalUsername').text(data.username);
            $('td#orderModalPrice').html("<span class='right'><span>PHP</span> <span style='margin-left:auto;'>"+numberWithCommas(data.price) + "</span></span>");
            $.each( data.order, function( i, item ) {
                if(item.quantity != 0){
                    $( "<tr>" ).appendTo( "#orderModalOrders" );
                    $( "<td>" ).text( item.menu.name ).appendTo( "#orderModalOrders" );
                    $( "<td>" ).text( item.quantity ).appendTo( "#orderModalOrders" );
                    $( "<td>" ).html( "<span class='right'><span>PHP</span> <span style='margin-left:auto;'>" + numberWithCommas(item.menu.price) + "</span></span></td>").appendTo( "#orderModalOrders" );
                    $( "<td>" ).html( "<span class='right'><span>PHP</span> <span style='margin-left:auto;'>" + numberWithCommas(item.menu.price * item.quantity) + "</span></span></td>").appendTo( "#orderModalOrders" );
                    $( "</tr>" ).appendTo( "#orderModalOrders" );
                }
            });
        });
    });
    $('#table').DataTable();

});
@endsection
