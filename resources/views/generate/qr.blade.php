@extends('costumer.layout')

@section('content')
{!!$qr!!}
UserID:{{$transaction['username']}}
Password:{{$password}}
Table:{{$transaction['table_id']}}
@endsection