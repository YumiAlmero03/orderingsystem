@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col">
        <table id="costumer-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Table</th>
                    <th>Costumer</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Void</th>
                </tr>

            </thead>
            <tbody>
            @foreach ($tables as $table)
            <tr>
                <td>{{$table->id}}</td>
                <td>{{$table->transaction['username']}}</td>
                <td>{{$table->transaction['status']}}</td>
                <td>
                    <form  method="POST" action="/status-change">
                        @csrf
                        <input type="hidden" name="id" value="{{$table->transaction['id']}}">
                        @switch($table->status)
                        @case('recording')
                            <a href=""><button type="submit" class="btn btn-primary">Record</button></a>
                            <input type="hidden" name="status" value="cooking">
                        @break
                        @case('cooking')
                            <a href=""><button type="submit" class="btn btn-primary">Prepare</button></a>
                            <input type="hidden" name="status" value="preparing">
                        @break
                        @case('preparing')
                            <a href=""><button type="submit" class="btn btn-primary">Serve</button></a>
                            <input type="hidden" name="status" value="serving">
                        @break
                        @case('serving')
                            <a href=""><button type="submit" class="btn btn-primary">Served</button></a>
                            <input type="hidden" name="status" value="eating">
                        @break
                        @case('eating')
                            <a href=""><button type="submit" class="btn btn-primary">Bill-Out</button></a>
                            <input type="hidden" name="status" value="billout">
                        @break
                        @case('billout')
                            <a href=""><button type="submit" class="btn btn-primary">Paid</button></a>
                            <input type="hidden" name="status" value="paid">
                        @break
                        @case('paid')
                            <a href=""><button type="submit" class="btn btn-primary">Done</button></a>
                            <input type="hidden" name="status" value="done">
                        @break
                        @default
                            Wait
                @endswitch
                    </form>
                </td>
                <td>
                    @if($table->status === 'done' || $table->status === 'void')
                    @else
                    <a href="{{route('void', ['id'=> $table->transaction['id']])}}"><button type="submit" class="btn btn-primary">Void</button></a>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col">
        <div class="nav flex-column" id='request'>
        </div>
    </div>
</div>

@endsection

@section('script')

$(document).ready( function () {
    var table = $('#costumer-table').DataTable({
            "processing": true,
            "serverSide": true,
            "paging":   false,
        "ordering": false,
        "info":     false,
        "search": false,
        "bFilter": false,
            "ajax": {
                "url" : '/api/costumers',
                "dataSrc": ''
            },
            "columns":[
                {"data" : 'table.id'},
                {"data" : 'table.transaction',
                "render" : function(data, type, row){
                        if(!data || data.status === 'done'){
                            return '';
                        } else {
                            return data.username;
                        }
                    }
                },
                {"data" : 'table.transaction.status',
                "render" : function(data, type, row){
                        if(!data || data === 'done'){
                            return '';
                        } else {
                            return data;
                        }
                    }
                },
                
                {"data" : 'table',
                    "searchable": false,
                    "orderable":false,
                    "render": function (data, type, row) {
                        var $title = '';
                        var $next = '';
                        if(data.transaction){
                            switch (data.transaction.status) {
                                case 'recording':
                                    $title = 'Record';
                                    $next = 'cooking';
                                    break;
                                case 'cooking':
                                    $title = 'Prepare';
                                    $next = 'preparing';
                                    break;
                                case 'preparing':
                                    $title = 'Serve';
                                    $next = 'serving';
                                    break;
                                case 'serving':
                                    $title = 'Served';
                                    $next = 'eating';
                                    break;
                                case 'eating':
                                    $title = 'Bill-Out';
                                    $next = 'billout';
                                    break;
                                case 'billout':
                                    $title = 'Paid';
                                    $next = 'paid';
                                    break;
                                case 'paid':
                                    $title = 'Done';
                                    $next = 'done';
                                    break;
                                case 'done':
                                    $title = 'Wait';
                                    $next = 'done';
                                    break;
                                default:
                                    $title = 'Wait';
                                    break;
                            }
                            if ($title != 'Wait') {

                                return '<form id="table-status" method="POST" action="/status-change">'+'@csrf'+'<input type="hidden" name="id" value="'+data.transaction.id+'"><a href=""><button type="submit" class="btn btn-primary">'+$title+'</button></a><input type="hidden" name="status" value="'+$next+'"></form>';
                            } else {
                                return $title;
                            } 
                        } else {
                            return 'Wait';
                        }
                    }
                },
                {"data" : 'table',
                "render": function (data, type, row) {
                    if(data.transaction){
                        if(data.status === "done" || data.status === "void"){}
                        else{
                            return data.status+"<a href='/void-order/"+data.transaction.id+"'><button type='submit' class='btn btn-primary'>Void</button></a>";
                        }
                    }
                    
                    return "";
                }
                },

            ]

        }
    );
    setInterval( function () {
        table.ajax.reload( null, false ); // user paging is not reset on reload
    }, 3000 );

obj = { table: "customers", limit: 20 };
dbParam = JSON.stringify(obj);

function loadRequest(){
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        var txt;
        txt += "<div class='card'>";
        for (x in myObj) {
          txt += " <div class='card-header'><h2>" + myObj[x].table_id + "</h2></div>";
          txt += " <div class='card-body'><h2>" + myObj[x].content + "</h2></div>";
          txt += " <div class='card-footer'><form method='POST' action='{{ route('request.remove') }}'><input type='hidden' name='id' value='" + myObj[x].id + "'><input type='hidden' name='_token' value='";
            txt += document.getElementById("csrf").value;
          txt +="'><button class='btn btn-primary' type='submit'>DONE</button></div>";

        }
        txt += "</div>";
        document.getElementById("request").innerHTML = txt;
      }
    }
    xmlhttp.open("GET", "/api/request-list", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("x=" + dbParam); 
}

setInterval(loadRequest, 2000);
});



@endsection
@section('data')
api/costumers @endsection
