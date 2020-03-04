@extends('layouts.app')

@section('style')
#request .col-3{
padding:0;
}
.done{
background-color:mistyrose;
}
.new{
background-color:orange;
}
.ordered{
background-color:yellow;
}
.served{
background-color:lightgreen;
}
.paid{
background-color:lightblue;
}
.manual{
background-color:violet;
}
form center{
    display:flex;
}
form center *{
    flex:auto;
}
h2{
    display:flex;
}
span.right{
    margin-left:auto;
}
@endsection
@section('content')

<div class="row " id='request'>

</div>
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
                <th>Total</th>
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
$(document).ready(function(load) {

    function loadRequest(){
        $.getJSON( "/api/costumers", function(data) {
            $("#request").html('');
            var txt = '';
            $.each(data, function(i, table) {
                table = table.table;
                txt += "<div class='card col-3'>";
                txt += " <div class='card-header'><h2><span>Table:" + table.id +"</span><span class='right'>" + table.status +"</span></h2></div>";
                if(table.status == "done" || table.status == "void" || table.status == "vacant"){
                    txt += " <div class='card-body done'>";
                }
                else if(table.status == "reserved" || table.status == "ordering" || table.status == "reordering"){
                    txt += " <div class='card-body new'>";
                }
                else if(table.status == "recording" || table.status == "cooking" || table.status == "preparing"){
                    txt += " <div class='card-body ordered'>";
                }
                else if(table.status == "manual"){
                    txt += " <div class='card-body manual'>";
                }
                else if(table.status == "serving" || table.status == "eating"){
                    txt += " <div class='card-body served'>";
                }
                else if(table.status == "billout" || table.status == "paid"){
                    txt += " <div class='card-body paid'>";
                }
                else{
                    txt += " <div class='card-body'>";
                }
                if(table.transaction ){
                if(table.status == "done" || table.status == "void"  || table.status == "vacant"){}
                else{
                    txt += "<table>"
                    if(table.transaction.order){
                        txt += "<tr><th>Menu</th><th>Quantity</th><th>Price</th><th>Total</th></tr>"
                        $.each(table.transaction.order, function(i, order) {
                            if(order.quantity != 0){
                                txt += "<tr><td>"+order.menu.name+"</td><td>"+order.quantity+"</td><td>"+order.menu.price+"</td><td>"+order.menu.price*order.quantity+"</td></tr>"
                            }
                        });
                    }
                    txt += " </table>";
                }}
                txt += "</div>";
                txt += " <div class='card-footer'>";
                if(table.status == "done" || table.status == "void" || table.status == "vacant"){
                    txt += "<center><h3>Vacant</h3></center>"
                } else {
                if(table.transaction){

                        txt += '<form method="post" action="/status-change"><center>';
                        txt += ' @csrf';
                        txt += ' <input type="hidden" name="id" value="'+table.transaction.id+'">';
                        if(table.status == "recording"){
                            txt += '<a><button type="submit" class="btn btn-primary">Record</button></a>';
                            txt += '<input type="hidden" name="status" value="cooking">';
                        } else if(table.status == "cooking"){
                            txt += '<a><button type="submit" class="btn btn-primary">Prepare</button></a>';
                            txt += '<input type="hidden" name="status" value="preparing">';
                        } else if(table.status == "preparing"){
                            txt += '<a><button type="submit" class="btn btn-primary">Serve</button></a>';
                            txt += '<input type="hidden" name="status" value="served">';
                        } else if(table.status == "served"){
                            txt += '<a><button type="submit" class="btn btn-primary">Served</button></a>';
                            txt += '<input type="hidden" name="status" value="eating">';
                        } else if(table.status == "eating"){
                            txt += '<a><button type="submit" class="btn btn-primary">Bill Out</button></a>';
                            txt += '<input type="hidden" name="status" value="billout">';
                        } else if(table.status == "billout"){
                            txt += '<a><button type="submit" class="btn btn-primary">Paid</button></a>';
                            txt += '<input type="hidden" name="status" value="paid">';
                        } else if(table.status == "paid"){
                            txt += '<a><button type="submit" class="btn btn-primary">Done</button></a>';
                            txt += '<input type="hidden" name="status" value="done">';
                        } else if(table.status == "manual") {
                            txt += '<button type="submit" class="btn btn-primary">Done</button>';
                            txt += '<input type="hidden" name="status" value="done">';
                            txt += '<a href="/qrto/'+table.transaction.username+'/'+table.transaction.pass+'/qrcode"><button type="button" class="btn btn-primary">Order</button></a>';
                        } else {
                            txt += "<h3>Wait</h3>"
                        }
                        txt += "<a href='/void-order/"+table.transaction.id+"'><button type='submit' class='btn btn-primary'>Void</button></a></center></form>";
                    }}

                    txt += "</div></div>";
                });

            $("#request").append(txt);
        });
    }
    loadRequest()
    setInterval(loadRequest, 3000);
});



@endsection
@section('data')
api/costumers @endsection
