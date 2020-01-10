@extends('app')

@section('simple crud', 'Simple CRUD')

@section('sidebar')
    @parent
    <p>Product listing.</p>
@endsection
@section('content')
    @foreach($products as $key => $value)
        <p>
            <a href="/products/{{$value->id}}">
                Product: {{ $value->id }} - {{ $value->name }}
            </a>
        </p>
    @endforeach

    <a href="/products/create">
        CREATE
    </a>
@endsection
