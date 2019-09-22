@extends('costumer.layout')

@section('content')
{!!$qr!!}
user:{{$transaction['username']}}
pass:{{$password}}
pass:{{$transaction['table_id']}}
@endsection